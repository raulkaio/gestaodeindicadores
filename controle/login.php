<?php
function anti_injection($sql){
$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/","",$sql);
$sql = trim($sql);
$sql = strip_tags($sql);
$sql = addslashes($sql);
return $sql;
}

$login = anti_injection($_POST["login"]);
$senha = anti_injection($_POST["senha"]);

include('conexao.php');
$query = mysql_query("select * from mxusuario where login = '$login' and senha = '$senha' and status='A'");
    if (!$query) {
        die("Erro no banco de dados." . mysql_error());
    }

    if (mysql_num_rows($query) > 0) {
        $dados = mysql_fetch_array($query);
        $codusuario = $dados['codusuario'];
        $email = $dados['email'];
        $login = $dados['login'];
        $usuario = $dados['usuario'];
        $time = time();
        
        session_start();
        session_cache_expire(5);
        $_SESSION['usuario'] = array("codusuario" => $codusuario , "email" => $email , "login" =>$login , "usuario" => $usuario, "time" => $time);
        header("location: ../inicio.php");
    } else {
        header("location: ../index.php?class=alert-error&titulo=Erro!&mensagem=Usuário e/ou senha inválidos.");
    }
?>
