<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContatosRepository;

/**
 * @ORM\Entity(repositoryClass=ContatosRepository::class)
 */
class Contatos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type= "string")
     */
    private String $nome;

    /**
     * @ORM\Column(type= "string")
     */

    private string $numero;

    /**
    * @ORM\Column(type= "string")
     */
    private String $email;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): String
    {
        return $this->nome;
    }

    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNumero(): String
    {
        return $this->numero;
    }

    public function setNumero($numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEmail(): String
    {
        return $this->email;
    }

    public function setEmail($email): Self
    {
        $this->email = $email;

        return $this;
    }
    
}
