<?php

namespace App\Model;

class Cliente
{
    /**
     * Identificador único do contato
     * @var integer
     */
    private $id;
    /**
     * Nome do cliente obrigatorio
     * @var string
     */
    private $nome;
    /**
     * CPF do cliente obrigatorio valido e unico
     * @var string
     */
    private $cpf;
    /**
     * Telefone do cliente obrigatorio formatado
     * @var string
     */
    private $telefone;
    /**
     * Data de nascimento
     * @var string
     */
    private $dataNascimento;
   
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }
    
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCpf()
    {
        return $this->cpf;
    }
    
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }
    
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
}
