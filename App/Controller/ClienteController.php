<?php

namespace App\Controller;

use App\Services\ClienteService;
use App\Validators\ValidatorCliente;
use App\Model\Cliente;

require_once 'vendor/autoload.php';

class ClienteController
{
    private $clienteService = null;

    public function __construct()
    {
        $this->clienteService = new ClienteService();
    }

    public function handleRequest($url)
    {
        try {
            $url = explode('/', $url);
            if ($url[0] == "index") {
                require_once 'pages/' . $url[0] . '.php';
                die;
            } elseif ($url[0] == "cliente") {
                if ($_SERVER["REQUEST_METHOD"] == "POST"):
                    header('Content-Type: application/json; charset=utf-8');
                $dataJSON = file_get_contents('php://input');
                $data= json_decode($dataJSON, true);

                if ($data['action'] == "save") {
                    $cliente = $this->saveCliente($dataJSON, $data);
                    return $cliente;
                } elseif ($data['action'] == "update") {
                    $cliente = $this->editCliente($dataJSON, $data);
                    return $cliente;
                } elseif ($data['action'] == "delete") {
                    $cliente = $this->deleteCliente($dataJSON);
                    return $cliente;
                } elseif ($data['action'] == "findById") {
                    $cliente = $this->findByIdCliente($dataJSON, $data);
                    return $cliente;
                } elseif ($data['action'] == "filterByCliente") {
                    $cliente = $this->filterByCliente($data['filter']);
                    return $cliente;
                }
                endif;

                if ($_SERVER["REQUEST_METHOD"] == "GET"):
                    $cliente = $this->listClientes();
                return $cliente;
                endif;
            }
        } catch (Exception $e) {
            require_once 'pages/error.php';
            die;
        }
    }

    public function listClientes()
    {
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
        return $this->clienteService->getAllClientes($orderby);
    }
    
    public function filterByCliente($filter)
    {
        return $this->clienteService->filterByCliente($filter);
    }
    
    public function saveCliente($dataJSON, $data)
    {
        $validatorCliente = new ValidatorCliente();
        $cliente = new Cliente();
        try {
            $cliente = $validatorCliente->filterSanitize($dataJSON, $data);
            $this->clienteService->createNewCliente($cliente);
            return array('status' => "200", 'msg' => 'Cliente inserido com successo!');
        } catch (ValidationException $e) {
            $errors = $e->getErrors();
            return array('status' => "500", 'msg' => "Falha ao inserir Cliente! $errors");
        }
    }
    
    public function editCliente($dataJSON, $data)
    {
        $validatorCliente = new ValidatorCliente();
        $cliente = new Cliente();
        try {
            $cliente = $validatorCliente->filterSanitize($dataJSON, $data);
            $this->clienteService->editCliente($cliente);
            return array('status' => "200", 'msg' => 'Cliente alterado com successo!');
        } catch (ValidationException $e) {
            $errors = $e->getErrors();
            return array('status' => "500", 'msg' => 'Falha ao alterar!');
        }
    }

    public function deleteCliente($dataJSON)
    {
        $validatorCliente = new ValidatorCliente();
        $cliente = new Cliente();
        $cliente = $validatorCliente->deleteValidaCliente($dataJSON);

        $errors = array();
        try {
            $this->clienteService->deleteCliente($cliente);
            return array('status' => "200", 'msg' => 'Cliente deletado com successo!');
        } catch (ValidationException $e) {
            $errors = $e->getErrors();
            return array('status' => "500", 'msg' => "Falha ao deletar! $errors");
        }
    }

    public function findByIdCliente($dataJSON, $data)
    {
        $validatorCliente = new ValidatorCliente();
        $cliente = new Cliente();
        $cliente = $this->clienteService->getCliente($validatorCliente->findByIdCliente($dataJSON, $data));
        return $cliente;
    }
    
    public function index()
    {
        return 'index';
    }
}
