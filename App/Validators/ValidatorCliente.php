<?php

namespace App\Validators;

use App\Model\Cliente;

require_once 'vendor/autoload.php';

class ValidatorCliente
{
    private $cliente = null;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }
    
    public function filterSanitize($dataJSON, $data)
    {
        $clientes = filter_var_array(json_decode($dataJSON, true), [
            'id'    => FILTER_SANITIZE_NUMBER_INT,
            'nome'    => FILTER_SANITIZE_STRING,
            'cpf'    => FILTER_SANITIZE_STRING,
            'telefone' => FILTER_SANITIZE_STRING,
        ]);
        
        $this->cliente->setId($this->validate_input($clientes['id']));
        $this->cliente->setNome($this->validate_input($clientes['nome']));
        $this->cliente->setTelefone($this->validate_input($clientes['telefone']));
        $this->cliente->setCpf($this->validate_input($clientes['cpf']));
        $this->cliente->setDataNascimento($data['dataNascimento']);
            
        if (empty($this->cliente->getNome())):
            $retorno = array('nome' => '', 'msg' => 'Por favor preencha o nome!');
        echo json_encode($retorno);
        exit();
        endif;
       
        if (empty($this->cliente->getCpf())):
            $retorno = array('cpf' => '', 'msg' => 'Por favor preencha o cpf!');
        echo json_encode($retorno);
        exit();
        endif;
        
        if (empty($this->cliente->getTelefone())):
            $retorno = array('telefone' => '', 'msg' => 'Por favor preencha o telefone!');
        echo json_encode($retorno);
        exit();
        endif;
        
        if (empty($this->cliente->getDataNascimento())):
            $retorno = array('dataNascimento' => '', 'msg' => 'Por favor preencha Data de Nascimento!');
        echo json_encode($retorno);
        exit();
        endif;

        return $this->cliente;
    }

    public function findByIdcliente($dataJSON, $data)
    {
        $clientes = filter_var_array(json_decode($dataJSON, true), [
            'id'    => FILTER_SANITIZE_NUMBER_INT
        ]);
            
        $idcliente = $this->validate_input($clientes['id']);
        $this->cliente->setId($idcliente);
        return $this->cliente;
    }
    
    public function deleteValidaCliente($dataJSON)
    {
        $clientes = filter_var_array(json_decode($dataJSON, true), [
            'id'    => FILTER_SANITIZE_NUMBER_INT
        ]);
            
        $this->cliente->setId($this->validate_input($clientes['id']));

        if (!$clientes):
            $retorno = array('status' => "500", 'msg' => 'id invalid cliente administrador!');
        echo json_encode($retorno);
        exit();
        endif;

        return $this->cliente;
    }
    
    public function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
