<?php include "base.php"; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrar-se</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="main">
		<?php
			if(!empty($_POST['username']) && !empty($_POST['password'])){
	    			$username = mysql_real_escape_string($_POST['username']);
	   		 	$password = md5(mysql_real_escape_string($_POST['password']));
	   		 	$email = mysql_real_escape_string($_POST['email']);
	   		 	$entrada = date('Y-m-d H:i:s');
	     
	     			$checkusername = mysql_query("SELECT * FROM users WHERE Username = '".$username."'");
	      
	     		if(mysql_num_rows($checkusername) == 1){//verifica se o usuário a ser registrado já existe.
	     			?>
	     			<div class="container">
	     				<div class="row">
	     					<div class="col-md-4 col-md-offset-4">
	     						<h1 class="text-center">Erro</h1>
	        					<p class="text-center">Esse usuário já existe.</p>
	        					<p class="text-center">Você será redirecionado em um instante!</p>
	        					<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=register.php">
	        				</div>	
	     				</div>
	     					
	     			</div>
	        		
	     		<?php 
	     	}
	     		else{//se não exister, insere ele na base de dados.
	        		$registerquery = mysql_query("INSERT INTO users (Username, Password, EmailAddress, Entrada) 
	        			VALUES('".$username."', '".$password."', '".$email."' , '".$entrada."')");
	        		if($registerquery){
	    ?>
	    				<script>
	    					alert("Cadastro realizado com sucesso! \nFaça login com sua nova conta.");
	    				</script>
	    				<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">
	    <?php
	        		}
	        		else{
	            		echo "<h1>Error</h1>";
	            		echo "<p>Sorry, your registration failed. Please go back and try again.</p>";    
	        		}       
	     		}
			}
			else{
	    ?>
	    <div class="container">
			    <div class="row">
					<div class="col-md-4 col-md-offset-4">
			    		<div class="panel panel-default">
						  	<div class="panel-heading">
						    	<h3 class="panel-title text-center">Registre-se</h3>
						 	</div>
						  	<div class="panel-body">
						    	<form method="post" action="register.php" name="registerform" id="registerform">
				                    <fieldset>
							    	  	<div class="form-group">
							    		    <input class="form-control" id="username" placeholder="Usuário" name="username" type="text">
							    		</div>
							    		<div class="form-group">
							    			<input class="form-control" id="password" placeholder="Senha" name="password" type="password">
							    		</div>
							    		<div class="form-group">
							    			<input class="form-control" id="email" placeholder="Email" name="email" type="text">
							    		</div>
							    		<input class="btn btn-lg btn-info btn-block" type="submit" value="Cadastrar">
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