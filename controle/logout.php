<?php
session_start();
unset($_SESSION['usuario']);
session_destroy();
header("location: /GESTAOdeINDICADORES/index.php?class=alert-info&titulo=Logout&mensagem=Logout efetuado com sucesso.");
?> 