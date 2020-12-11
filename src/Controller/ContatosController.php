<?php

namespace App\Controller;

use App\Entity\Contatos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContatosController
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function novoContato(Request $request): Response
    {
        $dadosRequest  = $request->getContent();
        $entidade  = new Contatos;

        $this->entityManager->persist($entidade);

        
    }
}









// public function celular($numero)
//     {
//         $numero = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $numero))))));

//         $regexCel = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/'; // Regex para validar somente celular
//         if (preg_match($regexCel, $numero)) {
//             return true;
//         } else {
//             return false;
//         }
//     }