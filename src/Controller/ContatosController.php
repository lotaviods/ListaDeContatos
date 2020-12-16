<?php

namespace App\Controller;

use App\Entity\Contatos;
use App\Helper\Validadores;
use App\Helper\EntidadeFactory;
use App\Helper\ResponseFactory;
use App\Helper\ExtratorDadosRequest;
use Psr\Cache\CacheItemPoolInterface;
use App\Repository\ContatosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class ContatosController 
{
    private $entityManager;

    private $validadores;

    private $extratorRequest;

    private $repository;

    private $cache;

   

    public function __construct(EntityManagerInterface $entityManager, 
                                Validadores $validadores, 
                                ExtratorDadosRequest $extratorRequest,
                                ContatosRepository $repository ,CacheItemPoolInterface $cache)

    {
        $this->entityManager = $entityManager;
        $this->validadores = $validadores;
        $this->extratorRequest = $extratorRequest;
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function NovoContato(Request $request): Response
    {
        $dadosRequest  = $request->getContent();
        $dados = json_decode($dadosRequest);

        $entidade  = new Contatos;

        $this->validadores->validadeNomeNoController($dados->nome);
        $entidade->setNome($dados->nome);

        $this->validadores->validaNumeroNoController($dados->numero);
        $entidade->setNumero($dados->numero);

        $this->validadores->validaEmailNoController($dados->email);
        $entidade->setEmail($dados->email);

        $this->entityManager->persist($entidade);

        $this->entityManager->flush();
        return new Response();
    }
    public function buscarContatos(Request $request): Response
    {
        $ordenacao = $this->extratorRequest->buscadorDadosOrdenacao($request);

        $filtro = $this->extratorRequest->bucadorDadosFiltro($request);

        [$paginaAtual, $itensPorPagina] = $this->extratorRequest->infoPaginacao($request);

        $lista = $this->repository->findBy($filtro, $ordenacao,$itensPorPagina,($paginaAtual-1)* $itensPorPagina);
        
        $responseFactory = new ResponseFactory(true, $lista, Response::HTTP_OK, $paginaAtual, $itensPorPagina);

        return $responseFactory->getResponse();
    }

   public function buscarUmContato(int $id)
    {
        $entidade = $this->cache->hasItem($this->cachePrefix() . $id)? $this->cache->getItem($this->cachePrefix(). $id)->get()
        :$this->repository->find($id);
        $statusReposta = is_null($entidade) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        $fabricaResposta = new  ResponseFactory(true, $entidade, $statusReposta);
        return $fabricaResposta->getResponse();
    }

    public function editarContato(int $id, Request $request)
    {
        $entidade = new Contatos();
        $entidadeExistente = $this->atualizarEntidadeExistente($id,$entidade);

        $this->entityManager->persist($entidade);
        $this->entityManager->flush();

        $cacheItem = $this->cache->getItem($this->cachePrefix() . $id);
        $cacheItem->set($entidadeExistente);
        $this->cache->save($cacheItem);

        new JsonResponse ($entidadeExistente);
    }

    public function atualizarEntidadeExistente(int $id, $entidade)
    {
          /** @var Contatos $entidadeExistente */
          
          $entidadeExistente = $this->repository->find($id);
        if(is_null($entidadeExistente)){
            throw new \InvalidArgumentException();
        }

        $entidadeExistente->setNome($entidade->getNome()
        ->setNumero($entidade->getNumero())->setEmail($entidade->getEmail()));
        
        return $entidadeExistente;
    }

    public function cachePrefix(): string
    {
        return 'contato_';
    }
}