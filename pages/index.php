<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Desafio Cuco - Cadastro de Clientes</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" charset="utf-8"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
  <script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="app" class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Clientes</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <div class="navbar-search-block">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/jhow.png" class="img-circle elevation-2" alt="Jonata">
          </div>
          <div class="info">
            <a href="#" class="d-block">Jonata Serpa</a>
          </div>
        </div>
      </div>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://github.com/jonataserpa" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Desafio CuCo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Cliente
                  </p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

 <div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Clientes</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Clientes</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="form-group col-sm-6">
                  <input type="text" class="form-control" v-model="pesquisa" id="search" placeholder="Pesquisar Clientes ...">
                </div>
                <div class="form-group col-sm-2">
                  <button v-on:click="search()" type="button" class="btn btn-block btn-outline-secondary btn-flat">
                    Pesquisar
                  </button>
                </div>
                <div class="form-group col-sm-2">
                  <button v-on:click="openForm(true)" type="button" class="btn btn-block btn-outline-secondary btn-flat" data-toggle="modal" data-target="#modalCliente">
                    Cadastrar
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="tableCliente" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Data Nascimento</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <tr v-for=" (cliente, index) in clientes  " :key="index"
                        v-on:dblclick="editCliente(cliente)">
                        <td title="Para editar de um doubleClick!">{{ cliente.id }}</td>
                        <td title="Para editar nome de um doubleClick!">{{ cliente.nome }}</td>
                        <td title="Para editar cpf de um doubleClick!">{{ cliente.cpf }}</td>
                        <td title="Para editar telefone de um doubleClick!">{{ cliente.telefone }}</td>
                        <td title="Para editar data de nascimento de um doubleClick!">{{ cliente.datanascimento }}</td>
                        <td v-on:click="removeCliente(cliente)"><i title="Remover cliente?"
                                class="far fa-times-circle"></i></td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modalCliente">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">   
          <h4 class="modal-title">{{ modal.title }} -> Cliente</h4>      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="card-body col-sm-12">
              <div class="form-group">
                <label for="nome">Nome <span class="text-danger">{{error.nome}}</span></label>
                <input type="text" class="form-control" v-model="cliente.nome" id="nome" placeholder="Ex: joao">
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="cpf">CPF <span class="text-danger">{{error.cpf}}</span></label>
                      <input type="text" class="form-control" v-model="cliente.cpf" id="cpf" placeholder="Ex: 333-333-333-33" maxlength="14" v-mask="maskcpf">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="telefone">Telefone <span class="text-danger">{{error.telefone}}</span></label>
                    <input type="text" class="form-control" v-model="cliente.telefone"  v-mask="masktelefone"  id="telefone" placeholder="(35)99743-3853">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="dataNascimento">Data Nascimento <span class="text-danger">{{error.dataNascimento}}</span></label>
                <input id="date" type="date" class="form-control" v-model="cliente.dataNascimento">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <span>{{messageResult}}</span>
          <button type="button" v-on:click="openForm(true)" class="btn btn-block btn-outline-secondary btn-flat col-sm-2" data-dismiss="modal">Sair</button>
          <button type="button" v-on:click="merge" class="btn btn-block btn-outline-success btn-flat col-sm-2">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 Criado por Jonata Serpa.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0-js
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/pages/vue-contact.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
