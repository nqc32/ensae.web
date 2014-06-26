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
			require_once("settings.php");
			echo '<a class="navbar-brand" href="velib.php">'.$project_name.'</a>' ;
			?>
          </div>
          		<div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
			 <?php
			 require_once("settings.php");
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
			  </ul>
              <!--<li class="active"><a href="./">Default</a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li><!-->
          </div><!--/.nav-collapse -->
        	</div><!--/.container-fluid -->
      	</div>
		 <div class="bs-docs-section" style="float:left;max-width:360px;">
			 
			 
			 test
		 </div>
</body>
</html>