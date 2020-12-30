<?php
namespace App\Controller;

use App\Entity\Contatos;
use App\Repository\ContatosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ControllerHtml extends AbstractController
{
    public function index()
    {
        return $this->render('Index\Index.html.twig');
    }

}
