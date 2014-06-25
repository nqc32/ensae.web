<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Geo-localisation et Velib</title>

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
		
		<!--OPEN STREET MAP
	  <style type="text/css">
	      html, body, #basicMap {
	          width: 100%;
	          height: 80%;
	          margin: 0;
	      }
	    </style>
	    <script src="openlayers/OpenLayers.js"></script>
	    <script>
	      function init() {
	        map = new OpenLayers.Map("basicMap");
	        var mapnik         = new OpenLayers.Layer.OSM();
	        var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
	        var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
	        var position       = new OpenLayers.LonLat(2.35,48.86).transform( fromProjection, toProjection);
	        var zoom           = 12; 
 
	        map.addLayer(mapnik);
	        map.setCenter(position, zoom );
	      }
	    </script>-->
			<!--Google Map -->
		    <style type="text/css">
		         html { height: 100% }
		         body { height: 80%; margin: 0; padding: 0 }
		         #map-canvas { height: 100% }
		     </style>
		       
			 <script type="text/javascript"
		         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4NInl2ygUk82FWxXwjUFQ9LFX9RR0V9o">
		     </script>
			   
			   
		     <script type="text/javascript">
		         function initialize() {
					 var myLatlng = new google.maps.LatLng(48.857091635218, 2.3417479951579);
		           var mapOptions = {
		             center: myLatlng,
		             zoom: 11,
					 
		           };
		           var map = new google.maps.Map(document.getElementById("map-canvas"),
		               mapOptions);
					   
		         }
		         google.maps.event.addDomListener(window, 'load', initialize);
		     </script>
			 
			 
			 
			
  </head>

  <body onload="initialize()">

    <div class="container">

      <!-- Static navbar -->
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
              echo '<li class="active"><a href=voir_carte.php>'.$page2.'</a></li>';
              echo '<li><a href="#">'.$page3.'</a></li>';
			 ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="./">Default</a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Velib par code postal</h1>
		<!-- Début Formulaire -->
		
		
		<form class="navbar-form navbar-left" role="search" method="POST">
		  
		  <div class="form-group">
		    <input type="text" name="code" class="form-control" placeholder="Code postal">
		  </div>
		 
		  <button type="submit" class="btn btn-default">Recherche</button>
		</form>
		
		
		<!-- Fin Formulaire -->
		</p>
    <p>Text à inclure</p> <br>
    <p>Blah</p><br>
		<div class="table-responsive">
		<?php
		require_once("db.class.php");
		
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
				echo "<td><a href=\"voir_carte.php?id=".$db->row['name']."\">Voir sur la carte</a></td>";
				#echo "<td>".$db->row['latitude']."</td>";
				#echo "<td>".$db->row['longitude']."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}
		?>
          </div>
          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
        </p>
		<!--<div id="basicMap"></div>
		  <div id="map-canvas"/>-->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
