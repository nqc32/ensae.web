<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
include_once 'includes/db.class.php';
include_once 'includes/pages.php';
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Projet : Géo-localisation et Velib</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
	

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">

    	<div class="navbar navbar-default" role="navigation">
        	<div class="container-fluid">
          	  <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<?php
			#require_once("settings.php");
			echo '<a class="navbar-brand" href="velib.php">'.$project_name.'</a>' ;
			?>
          </div>
          		<div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
			 <?php
			 #require_once("settings.php");
              echo '<li ><a href=velib.php>'.$page1.'</a></li>' ;
              echo '<li ><a href=voir_carte.php>'.$page2.'</a></li>';
              echo '<li><a href="voir_musee.php">'.$page3.'</a></li>';
			 ?>
               <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Visualiser <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="voir_carte.php">Station Vélib''</a></li>
                  <li class="divider"></li>
                  <li><a href="voir_musee.php">Musée</a></li>

                </ul>
              </li> <!-->
              </ul>
              <ul class="nav navbar-nav navbar-right" >
  				  <li class="active"><a href="connexion.php">Espace Personnel</a></li>
				  <?php
				  if (login_check($mysqli) == true){
					  echo '<li><a href="includes/logout.php">Déconnexion en tant que <strong>'.$_SESSION['username'].'</strong></a></li>';
				  }	
				  ?>
			  </ul>
              <!--<li class="active"><a href="./">Default</a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li><!-->
          </div><!--/.nav-collapse -->
        	</div><!--/.container-fluid -->
      	</div>
		<div class="jumbotron">
			<h3>Pages Personnels</h3>
		</div>
	  	  <?php
	  	  if (login_check($mysqli) != true){
	  		  echo '<div class="panel panel-primary" style="float:left;width:400px;margin:10px">';
	  	  }else{
	  	  	echo'<div class="panel panel-primary" style="float:left;width:400px;margin:10px;display:none">';
	  	  }
	  	  ?>
			
		  <div class="panel-heading">
		    <h3 class="panel-title">Nouvel utilisateur</h3>
		  </div>
          <?php
          if (!empty($error_msg)) {
              echo $error_msg;
          }
          ?>
		  <div class="panel-body" style="padding:20px;">			  
			<form role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>"  method ="post" name="registration_form">
			  <div class="form-group">
				<label for="username">Utilisateur</label>
				<input type="text" class="form-control" name="username" id="username" placeholder="Nom d'utilisateur">
			  </div>
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"/>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
			  </div>
			  
			  <div class ="form-group">
			  	<label for= "confirmpwd">Confirmer le mot de passe</label>
				<input type="password" class="form-control" name="confirmpwd" id="confirmpwd" placeholder ="Confirmer le mot de passe"/>
			  </div>
			  <div class ="form-group">
              <input type="button" 
			  		class="btn btn-default"
                     value="Souscrire" 
                     onclick="return regformhash(this.form,
                                     this.form.username,
                                     this.form.email,
                                     this.form.password,
                                     this.form.confirmpwd);" />
			  </div>
			</form>
		  </div>
		  </div>
	  <?php
	  if (login_check($mysqli) != true){
		  echo '<div class="panel panel-primary" style="float:left;width:400px;margin:10px;">';
	  }else{
	  	  echo'<div class="panel panel-primary" style="float:left;width:400px;margin:10px;display:none">';
	  }
	  ?>
		  <div class="panel-heading">
		    <h3 class="panel-title">Déjà enregistré</h3>
		  </div>
		  <div class="panel-body" style="padding:20px;">
	          <?php
	          if (isset($_GET['error'])) {
	              echo '<p class="error">Error Logging In!</p>';
	          }
	          ?>
			  <form action="includes/process_login.php" method="post" name="login_form">
			    <div class="form-group">
			      <label for="username_reg">Email address</label>
			      <input type="text" class="form-control" id="email_reg" name="email_reg" placeholder="Enter Email">
			    </div>
			    <div class="form-group">
			      <label for="password_reg">Password</label>
			      <input type="password" class="form-control" name ="password_reg" id="password_reg" placeholder="Password">
			    </div>
			    <div class="checkbox">
			    </div>
	            <input type="button" 
					   class="btn btn-default"
	                   value="Sousmettre" 
	                   onclick="formhash(this.form, this.form.password_reg);" />
			  </form>
		  </div>
		</div>
		<div class = "bs-docs-section" style="float:left">
			<div class="panel panel-success">
				<div class="panel-heading">
				        <h3 class="panel-title">Stations favorites</h3>
						<?php
						$_SESSION['username']
						?>
				</div>
			<div class="panel-body">
			    Panel content
			</div>
			</div>
			
		</div>	
		 
		
</body>
</html>