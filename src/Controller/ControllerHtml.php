<?php
namespace App\Controller;

use App\Entity\Contatos;
use App\Repository\ContatosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ControllerHtml extends AbstractController
{
    private $repostitory;

    public function __construct(ContatosRepository $repository)
    {
        $this->repostitory = $repository;
    }
    public function index()
    {   
        $contatos = $this->repostitory->findAll();
        return $this->render('Index\Index.html.twig', [
            "contatos" => $contatos
        ]);
    }

}
