﻿<?php 
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/controle/controle.php';
include $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/header.php';
?>

<div class="jumbotron">
        <h2>Cadastro de colaborador</h2>
		<div class="row">
		
		<form class="form-horizontal" action="/GESTAOdeINDICADORES/controle/cadastro.php" method="post">
		<div class="row">
			<div class="col-md-2" >
		  </div>
		  <div class="col-md-8">
		  
			<input type="text" name="nome" class="form-control" placeholder="Nome" required>
			<input type="number" name="matricula" class="form-control" placeholder="Matrícula" required>
			<input type="date" name="dtcontrat" class="form-control" placeholder="Data de contratação" required>
			<select class="form-control" name="funcao">
			   <?php
		  include('../controle/conexao.php');
		  $query = mysql_query("select f.codfuncao, f.nome as f_nome, d.nome as d_nome from mxfuncao f, mxdepartamento d where d.codepto = f.codepto order by f.nome asc");
			if (!$query) {
				die("Erro no banco de dados." . mysql_error());
			}
			if (mysql_num_rows($query) > 0) {
				while($dados = mysql_fetch_array($query)){
				$codfuncao = $dados['codfuncao'];
				$funcao = $dados['f_nome'];
				$departamento = $dados['d_nome'];
				echo'<option value="'.$codfuncao.'">'.$funcao.' - '.$departamento.'</option>';
				}
				echo '</select>';
			}
		  ?>
			</select>
			<input type="hidden" name="tipoform" value="4">
			<button type="submit" class="btn btn-primary btn-sm btn-block btn-success">Salvar</button>
		  </div>
		  <div class="col-md-2">
		  </div>
		</div>
		</form>
		
		<?php
	
		if(isset($_GET['titulo'])||isset($_GET['mensagem'])||isset($_GET['class'])){
			
			echo '<div class="alert '.$_GET['class'].' alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>'.$_GET['titulo'].'</strong> '.$_GET['mensagem'].'
				</div>';
		}
		?>
		</div>
		
		<div class="row">
		  <div class="col-md-2" >
		  </div>
		  <div class="col-md-8" >
		  <?php
		  include('../controle/conexao.php');
		  $query = mysql_query("SELECT c.matricula, c.nome, c.dtcontrat, f.nome as f_nome, d.nome as d_nome FROM mxcolab c, mxfuncao f, mxdepartamento d where c.codepto = d.codepto and c.codfuncao = f.codfuncao and f.codepto = d.codepto;");
			if (!$query) {
				die("Erro no banco de dados." . mysql_error());
			}
			if (mysql_num_rows($query) > 0) {
				echo '<br>
				<h3>Colaboradores cadastrados</h3>
				<table class="table table-striped">
				<thead><tr><th>Matrícula</th><th>Nome</th><th>Dt. Contratação</th><th>Função</th><th>Departamento</th></tr></thead>';
				while($dados = mysql_fetch_array($query)){
				$matricula = $dados['matricula'];
				$nome = $dados['nome'];
				$dtcontrat = $dados['dtcontrat'];
				$f_nome = $dados['f_nome'];
				$d_nome = $dados['d_nome'];
				echo'<tr><td>'.$matricula.'</td><td>'.$nome.'</td><td>'.$dtcontrat.'</td><td>'.$f_nome.'</td><td>'.$d_nome.'</td></tr>';
				}
				echo '</table>';
			} else {
				echo '<h4>Ainda, não existem colaboradores cadastrados.</h4>';
			}
		  ?>
		  </div>
		  <div class="col-md-2" >
		  </div>
		</div>
      </div>

<?php 
include $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/footer.php';?>