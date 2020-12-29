<?php
namespace App\Helper;

class Validadores
{
    public function validaNumeroNoController ($dados)
    {
        if($this->celular($dados) === false){
                throw new AppError("Número de telefone inválido");
            }
    }

    public function validaEmailNoController($dados)
    {
        if($this->email($dados) === false){
            throw new AppError("e-mail inválido");
        }
    }

    public function validadeNomeNoController($dados)
    {
        if($this->nome($dados) === false){
            throw new AppError("Nome inválido, o nome deve ter mais que três caracteres");
        }
    }

    private function celular($numero)
    {
        $numero = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $numero))))));

        $regexCel = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/'; // Regex para validar somente celular
        if (preg_match($regexCel, $numero)) {
            return true;
        } else {
            return false;
        }
    }

    private function email($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    private function nome($nome)
    {
        if(strlen($nome)<=3){
            return false;
        }
        return true;
    }
}