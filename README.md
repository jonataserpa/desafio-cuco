# Introdução

    Cadastro basico de um cliente utilizando o template do AdminLTE.

    Frontend responsavel pela camada de visao, envia os dados via json para o servidor backend onde realiza tambem as validações, separadas em camadas:
    1- Rotas: é verificado qual rota esta sendo redirecionada, somente aceita rotas validas, caso alguma rota seja invalida, será redirecionada para uma pagina de erro padrao.
    2- Controllers: responsavel por controlar as requisições e chamar os métodos responsavel, fazendo o parse do json para objeto, chamando a camada de validação.
    3- Model: classe responsavel pela estrutura do objeto do banco de dados.
    4- Service: Responsavel por redirecionar o serviço da camada DAO.
    5- DAO: responsavel por realizar a persistencia dos dados de forma eficiente com PDO utilizando prepareStatement em cada parametro.

# Aplicação CRUD - API de cliente

    -> front-end - Vuejs/REST/bootstrap 4.5 e AdminLTE
    -> back-end - PHP/REST/Mysql
    -> Arquitetura MVC
    -> Orientada a Objeto
    -> Design Pattern: Injeção de depencia
    -> Clean code
    -> Controle de rotas
    -> URLs amigaveis
    -> PSR-4

# Funcionalidades

    -> Realiza as seguintes operações:
    1- insere cadastro de cliente.
    2- realiza a alteração.
    3- realiza a deleção, é apenas atualizado o parametro fdeletado para true.
    4- realiza a busca,
    5- validação dos campos obrigatorios.

# Como usar Requisitos minimos

    1 - Composer, Servidor, Banco de dados todos ja funcionando corretamente.
    1 - Clonar a projeto e jogar na raiz do servidor php, não foi utilizado nenhum framework backend,
    2 - verificar se não tem outro projeto controlando o .htaccess,
    	caso esteja remover, depende dele para controle das rotas corretamente.
    3 - Rodar o script do banco que segue junto com o projeto cliente.sql no banco de dados cuco.
    4 - Pronto se tudo estiver correto apenas acessar http://localhost/ sera redirecionao a rota para index.php, basta cadastrar e realizar as operações basicas.

# API ROTAS EXEMPLO DE REQUISIÇÃO - POSTMAN

    Observação: Por questões de segurança foi adotado que todas as requisições tivessem o verbo POST para inserção, atualização, deleção, findById
    	adicionando um parametro action no corpo da requisição, o mesmo poderia ser no cabecalho, apenas a consulta o GET.

    "Segue os exemplos arquivo JSON a seguir": url padrao -> http://localhost/clientes

    1 - Para a consultas: GET -> localhost/clientes
    2 - Para inserção de um cliente -> POST -> localhost/clientes
    	{
    		"nome": "JOSE",
    		"cpf": "222.333.798-99",
    		"telefone": "(35) 9706-5544",
    		"dataNascimento": "1988-03-11",
    		"action" : "save"
    	}
    3 - Para atualização de um cliente: POST -> localhost/clientes
    	{
    		"id": "13",
    		"nome": "JOSE",
    		"cpf": "222.333.798-99",
    		"telefone": "(35) 9706-5544",
    		"dataNascimento": "1988-03-11",
    		"action" : "update"
    	}
    4 - Para a deleção de um cliente: POST -> localhost/clientes
    	{
    		"id": "15",
    		"action" : "delete"
    	}
    5 - Para a pesquisa de um cliente especifico : id -> POST -> localhost/clientes
    	{
    		"id": "14",
    		"action" : "findById"
    	}

Obrigado.

Jonata
Att.
