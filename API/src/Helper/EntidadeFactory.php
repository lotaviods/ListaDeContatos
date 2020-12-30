<?php

namespace App\Helper;

use Exception;
use App\Entity\Contatos;
use App\Repository\ContatosRepository;

class EntidadeFactory
{
    protected $repository;

    public function __construct(ContatosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function criarEntidade(string $json){

        $dadosEmJson = json_decode($json);

        $contato = new Contatos();
        $contato->setNome($dadosEmJson->nome)->setNumero($dadosEmJson->numero)->setEmail($dadosEmJson->email);
      
        return $contato;
    }

    public function atualizarEntidadeExistente(int $id, $entidade)
    {
          /** @var Contatos $entidadeExistente */
          
          $entidadeExistente = $this->repository->find($id);

        if(is_null($entidadeExistente)){
            throw new \InvalidArgumentException();
        }

        $entidadeExistente->setNome($entidade->getNome())->setNumero($entidade->getNumero())->setEmail($entidade->getEmail());
        
        return $entidadeExistente;
    }

}