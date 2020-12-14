<?php

namespace App\Controller;

use Throwable;
use App\Entity\Contatos;
use App\Helper\ExtratorDadosRequest;
use App\Helper\Validadores;
use App\Repository\ContatosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Helper\ResponseFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ContatosController
{
    private $entityManager;

    private $validadores;

    private $extratorRequest;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager, Validadores $validadores, ExtratorDadosRequest $extratorRequest,ContatosRepository $repository )
    {
        $this->entityManager = $entityManager;
        $this->validadores = $validadores;
        $this->extratorRequest = $extratorRequest;
        $this->repository = $repository;
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
}