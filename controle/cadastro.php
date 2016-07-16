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
1 - Cadastro de departamento
2 - Cadastro de funções
3 - Cadastro de tipo de meta
4 - 
*/

$tipoform = $_POST["tipoform"];

include('conexao.php');

/* TIPO 1 */
if ($tipoform == 1) {
$departamento = anti_injection($_POST["departamento"]);

$query = mysql_query("select * from mxdepartamento where nome = '".$departamento."'");
    if (!$query) {
        die("Erro no banco de dados." . mysql_error());
		header("location: /GESTAOdeINDICADORES/cadastro/departamento.php?class=alert-danger&titulo=Erro!&mensagem=Houve algum erro no banco de dados.");
    }
    if (mysql_num_rows($query) > 0) {
        header("location: /GESTAOdeINDICADORES/cadastro/departamento.php?class=alert-warning&titulo=Erro!&mensagem=Departmento já existe.");
    } else {
		$query = mysql_query("insert into mxdepartamento (nome) values ('".$departamento."')");
        header("location: /GESTAOdeINDICADORES/cadastro/departamento.php?class=alert-success&titulo=Tudo certo!&mensagem=Departamento cadastrado com sucesso.");
    }
}

/* TIPO 2 */
if ($tipoform == 2) {
$funcao = anti_injection($_POST["funcao"]);
$departamento = $_POST["departamento"];

$query = mysql_query("select * from mxfuncao where nome = '".$funcao."'");
    if (!$query) {
        die("Erro no banco de dados." . mysql_error());
		header("location: /GESTAOdeINDICADORES/cadastro/funcao.php?class=alert-danger&titulo=Erro!&mensagem=Houve algum erro no banco de dados.");
    }
    if (mysql_num_rows($query) > 0) {
        header("location: /GESTAOdeINDICADORES/cadastro/funcao.php?class=alert-warning&titulo=Erro!&mensagem=Função já existe.");
    } else {
		$query = mysql_query("insert into mxfuncao (nome,codepto) values ('".$funcao."',".$departamento.")");
        header("location: /GESTAOdeINDICADORES/cadastro/funcao.php?class=alert-success&titulo=Tudo certo!&mensagem=Função cadastrada com sucesso.");
    }
}

/* TIPO 3 */
if ($tipoform == 3) {
$nome = anti_injection($_POST["nome"]);
$tipometa = $_POST["tipometa"];
$tipovalor = $_POST["tipovalor"];
$vlmeta = $_POST["vlmeta"];
$vlpremio = $_POST["vlpremio"];
$funcao = $_POST["funcao"];

$query = mysql_query("select * from mxtipometa where nome = '".$nome."' and codfuncao = ".$funcao."");
    if (!$query) {
        die("Erro no banco de dados." . mysql_error());
		header("location: /GESTAOdeINDICADORES/cadastro/meta.php?class=alert-danger&titulo=Erro!&mensagem=Houve algum erro no banco de dados.");
    }
    if (mysql_num_rows($query) > 0) {
        header("location: /GESTAOdeINDICADORES/cadastro/meta.php?class=alert-warning&titulo=Erro!&mensagem=Meta já existe.");
    } else {
		$query = mysql_query("insert into mxtipometa (NOME, TIPOMETA, TIPOVALOR, VLMETA, VLPREMIO, CODFUNCAO) values ('".$nome."', '".$tipometa."', '".$tipovalor."', ".$vlmeta.", ".$vlpremio.", ".$funcao.")");
        header("location: /GESTAOdeINDICADORES/cadastro/meta.php?class=alert-success&titulo=Tudo certo!&mensagem=Função cadastrada com sucesso.insert into mxtipometa (NOME, TIPOMETA, TIPOVALOR, VLMETA, VLPREMIO, CODFUNCAO) values ('".$nome."', '".$tipometa."', '".$tipovalor."', ".$vlmeta.", ".$vlpremio.", ".$funcao.")");
    }
}

?>
