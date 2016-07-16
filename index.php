<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestão de indicadores</title>

<link href="/GESTAOdeINDICADORES/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/GESTAOdeINDICADORES/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/GESTAOdeINDICADORES/css/index_custom.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/GESTAOdeINDICADORES/images/favicon.png">
</head>

<body cz-shortcut-listen="true">
<div class="login-page">
  <div class="form">
    <form class="login-form" action="controle/login.php" method="post">
	<h4>Gestão de indicadores</h4>
      <input type="text" placeholder="login" name='login' id='login'/>
      <input type="password" placeholder="senha" name='senha' id='senha'/>
      <button>login</button>
    </form>
  </div>
</div>

		<div class="row">
		  <div class="col-md-4" >
		  </div>
		  <div class="col-md-4">
			<?php
	
			if(isset($_GET['titulo'])||isset($_GET['mensagem'])||isset($_GET['class'])){
				
				echo '<div class="alert '.$_GET['class'].' alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>'.$_GET['titulo'].'</strong> '.$_GET['mensagem'].'
					</div>';
			}
			?>
		  </div>
		  <div class="col-md-4">
		  </div>
		</div>

</body>
</html>