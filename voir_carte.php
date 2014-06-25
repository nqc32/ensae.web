<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Voir sur la carte</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
	
	
		    <style type="text/css">
		         html { height: 100% }
		         body { height: 80%; margin: 0; padding: 0 }
		         #map-canvas { height: 100% }
		     </style>
		       
			 <script type="text/javascript"
		         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4NInl2ygUk82FWxXwjUFQ9LFX9RR0V9o">
		     </script>	   
			 <?php
			 require_once("db.class.php");
	 		if(isset($_GET['id'])) $station=$_GET['id'];
	 		else $station="";
			$db = new DB();
			if ($station!="") {
				$req="SELECT *
				FROM velib 
				WHERE number= $station
				ORDER BY name";
				$db->query($req);
				while ($db->fetch_assoc()) {
					$lat=$db->row['latitude'] ;
					$long=$db->row['longitude'] ;
				}
				#$lat= 48.867091635218 ; 
				#$long= 2.3417479951579;
			}
			$db->close();	
			 ?>
		     <script type="text/javascript">
			 var map;
			 var markers = [];

			 function initialize() {
			   var haightAshbury = new google.maps.LatLng(48.857091635218, 2.3417479951579);
			   var mapOptions = {
			     zoom: 12,
			     center: haightAshbury,
			     //mapTypeId: google.maps.MapTypeId.TERRAIN
			   };
			   map = new google.maps.Map(document.getElementById('map-canvas'),
			       mapOptions);

			   // This event listener will call addMarker() when the map is clicked.
			   //google.maps.event.addListener(map, 'click', function(event) {
			     //addMarker(event.latLng);
			   //});

			   // Adds a marker at the center of the map.
			   //addMarker(haightAshbury);
			   
			   
			   var latitude = '<?php echo $lat; ?>' ;
			   var longtitude = '<?php echo $long; ?>' ;
			   var position2=new google.maps.LatLng(latitude, longtitude) ;
			   addMarker(position2);
			 }

			 // Add a marker to the map and push to the array.
			 function addMarker(location) {
			   var marker = new google.maps.Marker({
			     position: location,
			     map: map
			   });
			   markers.push(marker);
			 }

			 // Sets the map on all markers in the array.
			 function setAllMap(map) {
			   for (var i = 0; i < markers.length; i++) {
			     markers[i].setMap(map);
			   }
			 }

			 // Removes the markers from the map, but keeps them in the array.
			 function clearMarkers() {
			   setAllMap(null);
			 }

			 // Shows any markers currently in the array.
			 function showMarkers() {
			   setAllMap(map);
			 }

			 // Deletes all markers in the array by removing references to them.
			 function deleteMarkers() {
			   clearMarkers();
			   markers = [];
			 }

			 google.maps.event.addDomListener(window, 'load', initialize);

		     </script>
			
  </head>

<body>
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
              <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li ><a href=velib.php>Velib par Code Postal</a></li>
                <li class="active"><a href=voir_carte.php>Voir sur la Carte</a></li>
                <li><a href="#">Link</a></li>
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
          <h1>Voir sur la carte</h1>
  		<!-- Début Formulaire -->
  			<form id="code_postal" class="navbar-form navbar-left" role="select" method="POST" onchange="change()">
  		  	  Sélectionner le code postal 
				<div class="form-group">
  		    		<select type="number" name="code_postal" class="form-control" onchange="submit();return false;">
						<?php
						require_once("db.class.php");
						$db = new DB();
						$req="SELECT distinct cp
								FROM velib 
								ORDER BY cp";
						$db->query($req);
						while ($db->fetch_assoc()) {
							echo '<option VALUE ='.$db->row['cp'].'>'.$db->row['cp'].'</option>'; }
						$db->close();
						?>
					</select>
				</div>
  			</form>	
  			<form id="nom_station" class="navbar-form navbar-left" role="select" method="POST" >
  		  	  Nouveau Formulaire
				<div class="form-group">
  		    		<select name="name" class="form-control" >
						<option VALUE=0></option>
						<?php
						require_once("db.class.php");
						
						if(isset($_POST['code_postal'])) $filtre=$_POST['code_postal'];
						
						else $filtre="";						
						
						$db = new DB();
						
						$req="SELECT name
							FROM velib 
							WHERE cp = $filtre
							ORDER BY name";
						if ($filtre!=""){		
						$db->query($req);
						while ($db->fetch_assoc()) {
							echo '<option>'.$db->row['name'].'</option>'; 
						}
						}
						?>
					</select>
				</div>
  			</form>
			</p>
			<br>
		</div>
		
			<div id="map-canvas"/>
			<script>
		 	var myLatlng2 = new google.maps.LatLng(48.8, 2.3417479951579);
		 	addMarker(myLatlng2);
			</script> 
  		<!-- Fin Formulaire -->
<!-- 	

	require_once("db.class.php");
	if (isset($_GET['id'])) $_SESSION['id_velib']=$_GET['id'];
	$db = new DB(localhost,"root","cuong","cuong");
	$db->query("SELECT * FROM velib 
						WHERE ( name LIKE '".$_SESSION['id_velib']."%' ). "'");
	
	unset($_SESSION['id_ami']);
	
-->
</body>
</html>