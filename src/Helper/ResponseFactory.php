<?php

namespace Helper;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    protected $sucesso;

    protected $conteudoResposta;

    protected $statusResposta;

    protected $paginaAtual;

    protected $itemPorPagina;

    public function __construct(bool $sucesso,$conteudoResposta,int $statusResposta = Response::HTTP_OK, int $paginaAtual = null, int $itemPorPagina = null)
    {
        $this->sucesso = $sucesso;
        $this->conteudoResposta = $conteudoResposta;
        $this->statusResposta = $statusResposta;
        $this->paginaAtual = $paginaAtual;
        $this->$itemPorPagina = $itemPorPagina;
    }

    public function getResponse(): JsonResponse
    {
        $conteudoResposta = [
            "sucesso" => $this->sucesso,
            "paginaAtual" => $this->paginaAtual,
            "itensPorPagina" => $this->itemPorPagina,
            "conteudoResposta" => $this->conteudoResposta
        ];
        if(is_null($this->paginaAtual)){
            unset($conteudoResposta['paginaAtual']);
            unset($conteudoResposta['iTensPorPagina']);
        }

        return new JsonResponse ($conteudoResposta,$this->statusResposta);
    }


}
