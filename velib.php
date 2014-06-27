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
			echo '<a class="navbar-brand" href="velib.php">'.$project_name.'</a>' ;
			?>
          </div>
          		<div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
			 <?php
              echo '<li class="active"><a href=velib.php>'.$page1.'</a></li>' ;
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
  				  <li><a href="connexion.php">Espace Personnel</a></li>
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
        	<h1>Recherche par Code Postal</h1>
			<form class="navbar-form navbar-left" role="search" method="POST">
		   
			<div class="form-group">
		    	<input type="text" name="code" class="form-control" placeholder="Code postal">
		  	</div>
	
		  	<button type="submit" class="btn btn-lg btn-primary">Recherche</button>
			</form>
			
			<div class="table-responsive">
				<?php
					if(isset($_POST['code'])) $filtre=$_POST['code'];
					else $filtre="";
		
					$db = new DB();
					if ($filtre!="") {
					echo '<table class="table table-striped .table-condensed ">';
					echo "<thead>" ;
					echo " <tr>" ;
					echo " <th>Nom de station</th>" ;
					echo " <th>Adresse</th>" ;
					echo "<th><a href=\"voir_carte.php?codep=".$filtre."\">Tout Afficher</a></td>";
					echo " </tr>" ;
					echo " </thead>";
					echo " <tbody>" ;
					$req="SELECT *
						FROM velib 
						WHERE cp = $filtre
						ORDER BY name";
					$db->query($req);
			
					while ($db->fetch_assoc()) {
						echo "<tr>";
						echo "<td>".substr($db->row['name'],8)."</td>";
						echo "<td>".$db->row['address']."</td>";
						echo "<td><a href=\"voir_carte.php?codep=".$filtre."&id=".$db->row['number']."\">Voir sur la carte</a></td>";
				#echo "<td>".$db->row['latitude']."</td>";
				#echo "<td>".$db->row['longitude']."</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
			    }
				?>
        	</div>
			<br>
		</div>
		
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
