<?php 
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/controle/controle.php';
include $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/header.php';
?>

<div class="jumbotron">
        <h2>Cadastro de função <small>Inserir nome da função e selecionar departamento</small></h2>
		<div class="row">
		
		<form class="form-horizontal" action="/GESTAOdeINDICADORES/controle/cadastro.php" method="post">
		<div class="row">
			<div class="col-md-2" >
		  </div>
		  <div class="col-md-8">
			<input type="text" name="funcao" class="form-control" placeholder="Nome da função" required>
			<select class="form-control" name="departamento">
			   <?php
		  include('../controle/conexao.php');
		  $query = mysql_query("select codepto, nome from mxdepartamento order by codepto");
			if (!$query) {
				die("Erro no banco de dados." . mysql_error());
			}
			if (mysql_num_rows($query) > 0) {
				while($dados = mysql_fetch_array($query)){
				$codepto = $dados['codepto'];
				$nome = $dados['nome'];
				echo'<option value="'.$codepto.'">'.$codepto.' - '.$nome.'</option>';
				}
				echo '</select>';
			} else {
				header("location: ../index.php?class=alert-error&titulo=Erro!&mensagem=Usuário e/ou senha inválidos.");
			}
		  ?>
			</select>
			<input type="hidden" name="tipoform" value="2">
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
		  $query = mysql_query("select f.codfuncao, f.nome, d.nome as departamento from mxfuncao f, mxdepartamento d where f.codepto = d.codepto order by f.codfuncao");
			if (!$query) {
				die("Erro no banco de dados." . mysql_error());
			}
			if (mysql_num_rows($query) > 0) {
				echo '<br>
				<h3>Funções cadastradadas</h3>
				<table class="table table-striped">
				<thead><tr><th>#</th><th>Função</th><th>Departamento</th></tr></thead>';
				while($dados = mysql_fetch_array($query)){
				$codfuncao = $dados['codfuncao'];
				$funcao = $dados['nome'];
				$departamento = $dados['departamento'];
				echo'<tr><td>'.$codfuncao.'</td><td>'.$funcao.'</td><td>'.$departamento.'</td></tr>';
				}
				echo '</table>';
			} else {
				echo '<h3>Não há nenhuma função cadastrada.<br><small>Favor registrar primeiro um departamento.</small></h3>';
			}
		  ?>
		  </div>
		  <div class="col-md-2" >
		  </div>
		</div>
      </div>

<?php 
include $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/footer.php';?>