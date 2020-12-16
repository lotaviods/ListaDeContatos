<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

interface EntidadeFactory
{
    public function criarEntidade(string $json);
}
