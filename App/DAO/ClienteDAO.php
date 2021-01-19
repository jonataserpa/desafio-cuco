<?php

namespace App\DAO;

use App\Model\Cliente;
use App\Conection\DataBase;
use PDO;

require_once 'vendor/autoload.php';

class ClienteDAO extends DataBase
{
    private $conection = null;

    public function __construct()
    {
        //$this->conection = new DataBase();
    }

    public function selectAll($order)
    {
        if (!isset($order)) {
            $order = 'id';
        }
        $pdo = DataBase::connect($order);
        $sql = $pdo->prepare("SELECT id, nome, cpf, telefone, datanascimento, datacriacao  FROM cliente WHERE IFNULL(fdeletado, 0) =0");
        $sql->execute();

        $clientes = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
            $obj->datanascimento = date('d-m-Y', strtotime($obj->datanascimento));
            $clientes[] = $obj;
        }
        return ($clientes);
    }

    public function selectById($cliente)
    {
        $pdo = DataBase::connect();
        $sql = $pdo->prepare("SELECT * FROM cliente WHERE IFNULL(fdeletado, 0) =0 AND id = ?");
        $sql->bindValue(1, $cliente->getId());
        $sql->execute();

        $clientes = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
            $clientes[] = $obj;
        }
        return json_encode($clientes);
    }

    public function filterByCliente($filter)
    {
        $nome="";
        $cpf= "";
        $telefone= "";
        $fdeletado = " IFNULL(fdeletado, 0) =0 ";

        if ($filter != "") {
            $nome= " nome  ";
            $cpf= " OR cpf ";
            $telefone= " OR telefone ";
            $filter = " LIKE '%". $filter . "%'";
            $fdeletado = " AND IFNULL(fdeletado, 0) =0 ";
        }
        $pdo = DataBase::connect();
        $sql = $pdo->prepare("SELECT * FROM cliente WHERE $nome $filter $cpf $filter $telefone $filter $fdeletado ");
        $sql->bindValue(1, $filter);
        $sql->execute();

        $nameclientes = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
            $nameclientes[] = $obj;
        }
        return json_encode($nameclientes);
    }

    public function insert($cliente)
    {
        try {
            $pdo = DataBase::connect();
            $sql = $pdo->prepare("INSERT INTO cliente(nome, cpf, telefone, datanascimento) VALUES(?, ?, ?, ?)");
            $result = $sql->execute(array($cliente->getNome(), $cliente->getCpf(), $cliente->getTelefone(), $cliente->getDataNascimento()));
            $ultimoID = $pdo->lastInsertId();
        } catch (Exception $e) {
            if ($e->errorInfo[1] === 1062) {
                echo 'Duplicate entry';
            }
        }
    }
    
    public function edit($cliente)
    {
        try {
            $pdo = DataBase::connect();
            $sql = $pdo->prepare("UPDATE cliente SET nome= ?, cpf=?, telefone=?, datanascimento=? WHERE id = ? LIMIT 1");
            $result = $sql->execute(array($cliente->getNome(), $cliente->getCpf(), $cliente->getTelefone(), $cliente->getDataNascimento(), $cliente->getId()));
        } catch (Exception $e) {
            if ($e->errorInfo[1] === 1062) {
                echo 'Duplicate entry';
            }
        }
    }

    public function delete($cliente)
    {
        try {
            $pdo = DataBase::connect();
            $sql = $pdo->prepare("UPDATE cliente SET fdeletado=1 WHERE id =?");
            $sql->execute(array($cliente->getId()));
        } catch (Exception $e) {
            return $e;
        }
    }
}
