<?php

namespace App\Controller;

use Throwable;
use App\Entity\Contatos;
use App\Helper\Validadores;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;

class ContatosController
{
    protected $entityManager;

    protected $validadores;

    public function __construct(EntityManagerInterface $entityManager, Validadores $validadores)
    {
        $this->entityManager = $entityManager;
        $this->validadores = $validadores;
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

}