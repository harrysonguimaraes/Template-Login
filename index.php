<?php include "base.php"; ?>
<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
		if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){//se tem algo na sessão e o username está preenchido, então o usuário está logado.
    	?>
 	
		 	<div class="container-fluid">
		 		<section class="col-md-8 col-md-offset-2 teste">
		 	
		     			<h1 class="text-center">Área de membros</h1>
		     			<p class="text-center"> Você está logado como <code><?=$_SESSION['Username']?></code> e seu email é <code><?=$_SESSION['EmailAddress']?></code>.</p>
		     			<a href="logout.php"><p class="text-center">Sair</p></a>
		     		</section>
		     	</div>
      
    	<?php
		}elseif(!empty($_POST['username']) && !empty($_POST['password'])){//se o usuário preencheu usuário e senha, tenta autenticação.
	    		$username = mysql_real_escape_string($_POST['username']);//função realiza tratamento do input.
	    		$password = md5(mysql_real_escape_string($_POST['password']));//função md5 realiza encriptação.
	     
	    		$checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");//compara
	     
	    		if(mysql_num_rows($checklogin) == 1){//caso encontre o usuário e senha corretos, autentica
	        		$row = mysql_fetch_array($checklogin);
	        		$email = $row['EmailAddress'];
	         
	        		$_SESSION['Username'] = $username;
	        		$_SESSION['EmailAddress'] = $email;
	        		$_SESSION['LoggedIn'] = 1;
	         
	        		echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';

	    		}
	    		else{//se usuário e senha não combinarem, falha na autenticação.
	?>
	    			<div class="container-fluid">
			 		<section class="col-md-8 col-md-offset-2 teste">
			 			<h1 class="text-center">Erro</h1>
			 			<p class="text-center">Sua conta não foi encontrada. Por favor <a href="index.php">clique aqui e tente novamente.</a></p>
			     		</section>
		     		</div>
	<?php
	    		}
		}
		else{//se usuário não está logado e nem tentou logar, exibe caixa de login.
    	?>
    			<div class="container">
			    	<div class="row">
					<div class="col-md-4 col-md-offset-4">
			    			<div class="panel panel-default">
						  	<div class="panel-heading">
						    		<h3 class="panel-title text-center">Template de login </h3>
						 	</div>

						  	<div class="panel-body">
						    		<form method="post" action="index.php" name="loginform" id="loginform">
				                    		<fieldset>
								    	  	<div class="form-group">
								    		    <input class="form-control" id="username" placeholder="Usuário" name="username" type="text">
								    		</div>
								    		<div class="form-group">
								    			<input class="form-control" id="password" placeholder="Senha" name="password" type="password" value="">
								    		</div>
								    	    	<label>Não é usuário ainda? <a href="register.php">Registre-se</a></label>
								    		<input class="btn btn-lg btn-info btn-block" type="submit" value="Login">
							    		</fieldset>
						      	</form>
						    	</div>
						</div>
					</div>
				</div>
			</div>
     
   	<?php
		}
	?>
 
</div>
</body>
</html>
	
