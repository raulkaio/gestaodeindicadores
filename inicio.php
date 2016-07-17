<?php 
session_start();
require 'controle/controle.php';
include 'header.php';?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Bem vindo, Raul</h1>
        <p>Por favor, escolha uma das opções a seguir:
		
		<h2>Área de relatórios</h2>
		<div class="row">
		  <div class="col-md-6">
			<a href="" class="btn btn-primary btn-success btn-lg btn-block">Gratificação</a>
		  </div>
		  <div class="col-md-6">
			<a href="" class="btn btn-primary btn-success btn-lg btn-block">Boletins</a>
		  </div>
		</div>
		
		<h2>Área de cadastros</h2>
		  <div class="row">
		   <div class="col-md-3">
			<a href="/GESTAOdeINDICADORES/cadastro/indicador.php" class="btn btn-primary btn-lg btn-block">Registro de indicador</a>
		  </div>
		  <div class="row">
		   <div class="col-md-2">
			<a href="/GESTAOdeINDICADORES/cadastro/colaborador.php" class="btn btn-primary btn-lg btn-block">Colaborador</a>
		  </div>
			<div class="col-md-2">
			<a href="/GESTAOdeINDICADORES/cadastro/meta.php" class="btn btn-primary btn-lg btn-block">Metas</a>
		  </div>
		  <div class="col-md-2">
			<a href="/GESTAOdeINDICADORES/cadastro/funcao.php" class="btn btn-primary btn-lg btn-block">Funções</a>
		  </div>
		  <div class="col-md-2">
			<a href="/GESTAOdeINDICADORES/cadastro/departamento.php" class="btn btn-primary btn-lg btn-block">Departamentos</a>
		  </div>
		</div>
      </div>
 

<?php include 'footer.php';?>