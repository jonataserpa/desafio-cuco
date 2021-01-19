<?php

use App\Controller\ClienteController;

require_once 'vendor/autoload.php';

$route = new Route;

class Route
{
    private $routes;

    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function initRoutes()
    {
        $this->routes['/'] = array('Controller' => 'ClienteController', 'action' => 'index');
        $this->routes['/clientes'] = array('Controller' => 'ClienteController', 'action' => 'cliente');
    }

    protected function run($url)
    {
        if (array_key_exists($url, $this->routes)) {
            $cliente = new ClienteController();

            $return = $cliente->handleRequest($this->routes[$url]['action']);
            echo json_encode($return, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('status' => "500", 'msg' => "Falha de comunicação entre em contato com o administrador !"));
            require_once 'pages/error.php';
        }
    }

    public function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
