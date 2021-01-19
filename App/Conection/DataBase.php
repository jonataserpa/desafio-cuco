<?php

namespace App\Conection;

use PDO;

require_once 'vendor/autoload.php';

class Database
{
    private static $dbName 	   = 'cuco';
    private static $dbHost 	   = 'localhost';
    private static $dbUsername = 'root';
    private static $dbPassword = 'root';

    private static $conn = null;

    public function __construct()
    {
        echo "instance";
    }

    public static function connect()
    {
        if (null == self::$conn) {
            try {
                self::$conn =  new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            } catch (PDOException $e) {
                return array('codigo' => 0, 'msg' => $e->getMessage());
                die();
            }
        }
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn = null;
    }
}
