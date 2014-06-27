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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
			echo '<a class="navbar-brand" href="index.php">'.$project_name.'</a>' ;
			?>
          </div>
          		<div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
			 <?php
              echo '<li><a href=velib.php>'.$page1.'</a></li>' ;
              echo '<li><a href=voir_carte.php>'.$page2.'</a></li>';
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
			  <?php
 				  
			  
			  if (login_check($mysqli) == true){
				  echo '<li class="active"><a href="connexion.php">Bonjour <strong>'.$_SESSION['username'].'</strong></a></li>';
				  #echo '<li class="active">Bonjour <strong>'.$_SESSION['username'].'</strong></li>';
				  echo '<li><a href="includes/logout.php">Déconnexion </a></li>';
				  
			  }	else { 
				  echo '<li><a href="connexion.php">Espace Personnel</a></li>';
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
		<h2> Bienvenue sur le site du projet Web de géolocalisation ! </h2>
		<br> <h4> <button type="button" class="btn btn-default btn-lg"> <span class="glyphicon glyphicon-zoom-in"></span> </button> Ce site vous permet de géolocaliser des stations de Vélib' et des musées dans la région parisienne. </h4>
		<br>
		<ul class="list-group">
		<li class="list-group-item list-group-item"> <span class="glyphicon glyphicon-ok-circle"></span> Si vous souhaitez rechercher les stations ou les musées de votre arrondissement préféré, allez dans <a href ="velib.php"> Recherche </a> puis tapez le nom de votre arrondissement. Le site affiche les stations et les musées de l'arrondissement. Vous avez la possibilité de visualiser une station ou un musée sur la Google Maps en appuyant sur <a href ="#"> Voir sur la carte </a>. Si vous souhaitez visualiser toutes les stations de l'arrondissement, tapez sur <a href ="#"> Tout afficher </a>. </li>
		<li class="list-group-item list-group-item-success"> <span class="glyphicon glyphicon-ok-circle"></span> Pour afficher une station de Vélib' sur la carte, allez dans <a href ="voir_velib.php"> Station Vélib'</a> et tapez le nom de l'arrondissement puis le nom de la station recherchée. Vous avez ensuite la possibilité d'afficher les stations de Vélib' voisines et les musées alentours en modifiant le rayon de recherche.  </li>
		<li class="list-group-item list-group-item-info"> <span class="glyphicon glyphicon-ok-circle"></span> Pour afficher un musée sur la carte, allez dans <a href ="voir_musee.php"> Musée </a> et tapez le nom de l'arrondissement puis le nom du musée recherché. Vous avez ensuite la possibilité d'afficher les stations de Vélib' voisines et les musées alentours en modifiant le rayon de recherche.  </li>
		</ul>

		
		
		
		<br> <h4> <button type="button" class="btn btn-default btn-lg"> <span class="glyphicon glyphicon-user"></span> </button> Pour enregistrer vos stations de Vélib' et vos musées favoris, créez un compte dans l'onglet <a href ="connexion.php"> Espace personnel </a>
	
		
		</div>
		
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
