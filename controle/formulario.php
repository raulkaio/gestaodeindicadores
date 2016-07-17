<?php
function anti_injection($sql){
$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/","",$sql);
$sql = trim($sql);
$sql = strip_tags($sql);
$sql = addslashes($sql);
return $sql;
}

/*
TIPOS DE FORMULÁRIO
1 - Solicitação de formulário para cadastrar indicadores por analista
*/

$tipoform = $_POST["tipoform"];

/* TIPO 1 */
if ($tipoform == 1) {
$matricula = $_POST["matricula"];

include('conexao.php');
$query = mysql_query("select matricula, nome, dtcontrat, codepto, codfuncao from mxcolab where matricula = ".$matricula.";");
$dados = mysql_fetch_array($query);

$nome = $dados['nome'];
$dtcontrat = $dados['dtcontrat'];
$codfuncao = $dados['codfuncao'];
$codepto = $dados['codepto'];

$query = mysql_query("select * from mxtipometa where codfuncao = ".$codfuncao.";");
    if (!$query) {
        die("Erro no banco de dados." . mysql_error());
		header("location: /GESTAOdeINDICADORES/cadastro/indicador.php?class=alert-danger&titulo=Erro!&mensagem=Houve algum erro no banco de dados.");	
    }
    if (mysql_num_rows($query) > 0) {
		$query = mysql_query("select * from mxtipometa where codfuncao =".$codfuncao);
		include('../controle/conexao.php');
		  $query = mysql_query("select codmeta, nome from mxtipometa where codfuncao = ".$codfuncao.";");
			if (!$query) {
				die("Erro no banco de dados." . mysql_error());
			}
			if (mysql_num_rows($query) > 0) {
				$formulario = '<div class="row"><div class="col-md-4"></div><div class="col-md-4">';
				$formulario .= "<blockquote><p>".$matricula." - ".$nome."</p></blockquote>";
				
				while($dados = mysql_fetch_array($query)){
				$codmeta = $dados['codmeta'];
				$nome = $dados['nome'];
					$formulario .= '<input type="text" name="meta'.$codmeta.'" class="form-control" placeholder="'.$nome.'" required>';
				}
				
				$formulario .= '</div><div class="col-md-4"></div></div>';
			}
        header("location: /GESTAOdeINDICADORES/cadastro/indicador.php?formulario=".$formulario);
    }
	else {
		header("location: /GESTAOdeINDICADORES/cadastro/indicador.php?class=alert-warning&titulo=Erro!&mensagem=Não existem ainda nenhuma meta cadastrada para essa função. Por favor, cadastre uma meta em Menu Principal -> Metas e então retorne para o cadastro de indicadores.");
    }
}

?>
