<?php 
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/controle/controle.php';
include $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/header.php';
?>

<div class="jumbotron">
        <h2>Cadastro de tipo de meta<br>
		<small>Inserir nome da meta, seu valor ou deflator, e seu prêmio</small></h2>
		<div class="row">
		
		<form class="form-horizontal" action="/GESTAOdeINDICADORES/controle/cadastro.php" method="post">
		<div class="row">
			<div class="col-md-2" >
		  </div>
		  <div class="col-md-8">
		  
			<input type="text" name="nome" class="form-control" placeholder="Nome" required>
			
			<label class="radio-inline">
			  <input type="radio" name="tipometa" id="tipoMeta" value="M"> Meta
			</label>
			<label class="radio-inline">
			  <input type="radio" name="tipometa" id="tipoDeflator" value="D"> Deflator
			</label><br>
			
			<label class="radio-inline">
			  <input type="radio" name="tipovalor" id="tipoNumerico" value="N"> Número
			</label>
			<label class="radio-inline">
			  <input type="radio" name="tipovalor" id="tipoPercentual" value="P"> Percentual
			</label>
			
			<input type="text" name="vlmeta" class="form-control" placeholder="Valor da meta ou % do deflator" onKeyUp="formato_valor(this)" maxlength="5" required>
			
			<input type="text" name="vlpremio" class="form-control" placeholder="Valor do prêmio" required>
			
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
			<input type="hidden" name="tipoform" value="3">
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
		  $query = mysql_query("select t.codmeta, t.nome as t_nome, t.tipometa, t.tipovalor, t.vlmeta, t.vlpremio, f.nome as f_nome from mxtipometa t, mxfuncao f where f.codfuncao = t.codfuncao order by t.codmeta asc;");
			if (!$query) {
				die("Erro no banco de dados." . mysql_error());
			}
			if (mysql_num_rows($query) > 0) {
				echo '<br>
				<h3>Tipos de meta cadastradas</h3>
				<table class="table table-striped">
				<thead><tr><th>#</th><th>Meta</th><th>Tipo</th><th>Tipo valor</th><th>Valor</th><th>Prêmio</th><th>Função</th></tr></thead>';
				while($dados = mysql_fetch_array($query)){
				$codmeta = $dados['codmeta'];
				$t_nome = $dados['t_nome'];
				$tipometa = $dados['tipometa'];
				$tipovalor = $dados['tipovalor'];
				$vlmeta = $dados['vlmeta'];
				$vlpremio = $dados['vlpremio'];
				$f_nome = $dados['f_nome'];
				echo'<tr><td>'.$codmeta.'</td><td>'.$t_nome.'</td><td>'.$tipometa.'</td><td>'.$tipovalor.'</td><td>'.$vlmeta.'</td><td>'.$vlpremio.'</td><td>'.$f_nome.'</td></tr>';
				}
				echo '</table>';
			} else {
				echo '<h4>Não existem tipos de meta cadastradas.<br><small>Você pode cadastrar tipos de meta desde que já existam funções e departamentos cadastrados.</small></h4>';
			}
		  ?>
		  </div>
		  <div class="col-md-2" >
		  </div>
		</div>
      </div>

<?php 
include $_SERVER['DOCUMENT_ROOT'].'/GESTAOdeINDICADORES/footer.php';?>