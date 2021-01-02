<?php

namespace App\Controller;

use App\Helper\Cacher;
use App\Helper\AppError;
use App\Helper\Validadores;
use App\Helper\EntidadeFactory;
use App\Helper\ResponseFactory;
use App\Helper\ExtratorDadosRequest;
use Psr\Cache\CacheItemPoolInterface;
use App\Repository\ContatosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Driver\SQLSrv\Exception\Error;
use Doctrine\DBAL\Exception\ConnectionException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContatosController extends AbstractController
{
    private $entityManager;

    private $validadores;

    private $extratorRequest;

    private $repository;

    private $cache;

    private $factory;

    private $cacher;

    public function __construct(EntityManagerInterface $entityManager,
        Validadores $validadores,
        ExtratorDadosRequest $extratorRequest,
        ContatosRepository $repository, CacheItemPoolInterface $cache,
        EntidadeFactory $factory, Cacher $cacher) {
        $this->entityManager = $entityManager;
        $this->validadores = $validadores;
        $this->extratorRequest = $extratorRequest;
        $this->repository = $repository;
        $this->cache = $cache;
        $this->factory = $factory;
        $this->cacher = $cacher;
    }
    public function NovoContato(Request $request): JsonResponse
    {
        try {
            $entidade = $this->factory->criarEntidade($request->getContent());

            $this->validadores->validadeNomeNoController($entidade->nome);
            $entidade->setNome($entidade->nome);

            $this->validadores->validaNumeroNoController($entidade->numero);
            $entidade->setNumero($entidade->numero);

            $this->validadores->validaEmailNoController($entidade->email);
            $entidade->setEmail($entidade->email);

            $this->entityManager->persist($entidade);

            $this->entityManager->flush();
            
        } catch (\Error $erro) {
            throw new AppError("Ocorreu um erro inesperado: {$erro->getMessage()}");
        }
        $response = new ResponseFactory(true, $entidade, Response::HTTP_OK);
        return $response->getResponse();
    }
    public function buscarContatos(Request $request): Response
    {
        try {
            $ordenacao = $this->extratorRequest->buscadorDadosOrdenacao($request);

            $filtro = $this->extratorRequest->bucadorDadosFiltro($request);

            [$paginaAtual, $itensPorPagina] = $this->extratorRequest->infoPaginacao($request);

            try {
                $lista = $this->repository->findBy($filtro, $ordenacao, $itensPorPagina, ($paginaAtual - 1) * $itensPorPagina);
            } catch (ConnectionException $error) {
                throw new AppError('Erro ao se conectar ao busca ao banco de dados, verifique a existencia do mesmo');
            }
        } catch (\Error $erro) {
            throw new AppError("Ocorreu um erro inesperado: {$erro->getMessage()}");
        }
        $response = new ResponseFactory(true, $lista, Response::HTTP_OK, $paginaAtual, $itensPorPagina);
        return $response->getResponse();
    }

    public function buscarUmContato(int $id)
    {
        try {
            $entidade = $this->cache->hasItem($this->cacher->cachePrefix() . $id) ? $this->cache->getItem($this->cacher->cachePrefix() . $id)->get()
            : $this->repository->find($id);
            $statusReposta = is_null($entidade) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        } catch (\Error $erro) {
            throw new AppError("Ocorreu um erro inesperado: {$erro->getMessage()}");
        }
        $response = new ResponseFactory(true, $entidade, $statusReposta);
        return $response->getResponse();
    }

    public function editarContato(int $id, Request $request): JsonResponse
    {
        try {
            $entidade = $this->factory->criarEntidade($request->getContent());

            $entidadeExistente = $this->factory->atualizarEntidadeExistente($id, $entidade);

            $this->validadores->validadeNomeNoController($entidade->nome);
            $entidadeExistente->setNome($entidade->nome);

            $this->validadores->validaNumeroNoController($entidade->numero);
            $entidadeExistente->setNumero($entidade->numero);

            $this->validadores->validaEmailNoController($entidade->email);
            $entidadeExistente->setEmail($entidade->email);

            $this->entityManager->persist($entidadeExistente);
            $this->entityManager->flush();

            $cacheItem = $this->cache->getItem($this->cacher->cachePrefix() . $id);
            $cacheItem->set($entidadeExistente);
            $this->cache->save($cacheItem);

        } catch (\Error $erro) {
            throw new AppError("Ocorreu um erro inesperado: {$erro->getMessage()}");
        }
        $response = new ResponseFactory(true, $entidadeExistente, Response::HTTP_OK);
        return $response->getResponse();    
    }

    public function excluirContato(int $id): Response
    {
        try {
            $entidade = $this->repository->find($id);

            $this->entityManager->remove($entidade);
            $this->entityManager->flush();

            $this->cache->deleteItem($this->cacher->cachePrefix() . $id);

        } catch (\Error $erro) {
            throw new AppError("Ocorreu um erro inesperado: {$erro->getMessage()}");
        }
        $response = new ResponseFactory(true, '', Response::HTTP_NO_CONTENT);
        return $response->getResponse();
    }

}
