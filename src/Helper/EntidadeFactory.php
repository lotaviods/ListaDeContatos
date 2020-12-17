<?php

namespace App\Helper;

use App\Entity\Contatos;
use Exception;

class EntidadeFactory
{
    public function criarEntidade(string $json){

        $dadosEmJson = json_decode($json);
        $this->checkAllProperties($dadosEmJson);

        $contato = new Contatos();
        $contato->setNome($dadosEmJson->nome)->setNumero($dadosEmJson->numero)->setEmail($dadosEmJson->email);
      
        return $contato;
    }
    private function checkAllProperties(object $dadosEmJson)
    {
        if(!property_exists($dadosEmJson, 'nome')){
            throw new Exception('Contato precisa de nome');
        } 
        if(!property_exists($dadosEmJson, 'numero')){
            throw new Exception('Contato precisa de número');
        } 
        if(!property_exists($dadosEmJson,'email')){

            throw new Exception('Contato preicsa de e-mail');
        }
    }
}