<?php

namespace App\Services;

use App\DAO\ClienteDAO;
use App\Model\Cliente;
use App\Conection\DataBase;

require_once 'vendor/autoload.php';

class ClienteService extends ClienteDAO
{
    private $clienteDAO = null;

    public function __construct()
    {
        $this->clienteDAO = new ClienteDAO();
    }

    public function getAllClientes($order)
    {
        try {
            self::connect();
            $result = $this->clienteDAO->selectAll($order);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function getCliente($cliente)
    {
        try {
            self::connect();
            $result = $this->clienteDAO->selectById($cliente);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
        return $this->clienteDAO->selectById($cliente);
    }
    
    public function filterByCliente($filter)
    {
        try {
            self::connect();
            $result = $this->clienteDAO->filterByCliente($filter);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
    
    public function createNewCliente($cliente)
    {
        try {
            self::connect();
            $result = $this->clienteDAO->insert($cliente);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
    
    public function editCliente($cliente)
    {
        try {
            self::connect();
            $result = $this->clienteDAO->edit($cliente);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
    public function deleteCliente($cliente)
    {
        try {
            self::connect();
            $result = $this->clienteDAO->delete($cliente);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
}
