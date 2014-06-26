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
	 		 if(isset($_GET['id'])) $station=substr($_GET['id'],0,5);
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
					$info = $db->row['address'] ;
				}
				#$lat= 48.867091635218 ; 
				#$long= 2.3417479951579;
			 }
			 $db->close();	
			 ?>
		     <script type="text/javascript">
			 var map;
			 var markers = [];
		   	 var latitude = '<?php echo $lat; ?>' ;
		   	 var longtitude = '<?php echo $long; ?>' ;
			 //var address = '<?php echo $info; ?>' 
		   	 var position2=new google.maps.LatLng(latitude, longtitude) ; // position du point indiqué
			 
			 function initialize() {
			   var paris = new google.maps.LatLng(48.857091635218, 2.3417479951579);
			   var mapOptions = {
			     zoom: 13,
			     center: paris,
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
			   <?php
  			 	require_once("db.class.php");
  	 			if(isset($_GET['codep']) and ($_GET['id']==0)) $codepostal=$_GET['codep'];
  	 			else $codepostal="";
  				$db = new DB();
  				if ($codepostal!="") { //si le code postal est passé en argument
  					$req="SELECT *
  						FROM velib 
  						WHERE cp= $codepostal
  						ORDER BY name";
  					$db->query($req);
  					while ($db->fetch_assoc()) { // placer tous les points situés dans la zone
  						$lat =$db->row['latitude'] ;
  						$long=$db->row['longitude'] ;
						#$info =$db->row['name'] ;
						echo "var position = new google.maps.LatLng(".$lat.",".$long.");" ;
						echo "addMarker(position);" ;  
  					}
  				}
				#else echo "addMarker_info(position2,address);";  // si non, placer seulement le point indiqué
  				else echo "addMarker(position2);";
				$db->close();
			   	?>
			   //
			 }

			 // Add a marker to the map and push to the array.
			 function addMarker(location) {
			   var marker = new google.maps.Marker({
			     position: location,
			     map: map
			   });
			   markers.push(marker);
			 }
			 
			 function addMarker_info(location, info) {
			   var marker = new google.maps.Marker({
			     position: location,
			     map: map,
				 title : info
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
          <h1>Voir sur la carte</h1>
  		<!-- Début Formulaire -->
			<form id="code_postal" role="select" method="GET" >
				<div class="form-group">
					<label for="code postal">Sélectionner le code postal </label>
  		    		<select id="code postal" type="number" name="codep" class="form-control" onchange="submit();return false;">
						<option VALUE=0></option>
						<?php
						if(isset($_GET['codep'])) $remplie=$_GET['codep'] ;
						else $remplie="";
						
						#if ($remplie!=""){
						#	echo '<option selected="selected">'.$remplie.'</option>';
						#}
						require_once("db.class.php");
						$db = new DB();
						$req="SELECT distinct cp
								FROM velib 
								ORDER BY cp";
						$db->query($req);
						while ($db->fetch_assoc()) {
							if ($db->row['cp']!=$remplie){
								 echo '<option VALUE ='.$db->row['cp'].'>'.$db->row['cp'].'</option>';}
							else {
								echo '<option selected ="selected VALUE="'.$db->row['cp'] .'>'.$db->row['cp'] .'</option>';}
							}
							#}
						$db->close();
						
						?>
					</select>
				</div>
				<div class = "form-group">
					<label for="station velib">Station Vélib </label>
  		    		<select id="station velib" name="id" class="form-control" onclick="submit();return false">
						<option VALUE=0>Toutes les stations</option>
						<?php
						require_once("db.class.php");
						
						if(isset($_GET['codep'])) $filtre=$_GET['codep'];
						else $filtre="";						
							
						if(isset($_GET['id'])) $nom=$_GET['id'];
						else $nom="";	
						
						
						$db = new DB();
						if ($filtre!=""){
						$req="SELECT *
							FROM velib 
							WHERE cp = $filtre
							ORDER BY name";	
						$db->query($req);
						while ($db->fetch_assoc()) {
							if ($db->row['number']!=$nom){
								echo '<option VALUE ='.$db->row['number'].'>'.$db->row['name'].'</option>'; }
							else {
								echo '<option selected VALUE='.$db->row['number'].'>'.$db->row['name'] .'</option>';}
						}
						}
						$db->close();
						?>
					</select>
				</div>
  			</form>
			<div class="panel panel-success">
				 <div class="panel-heading">
					 <h3 class="panel-title">Addresse de la station sélectionnée</h3>
			   	</div>
				<div class="panel-body">
				<?php
					require_once("db.class.php");
				
					if(isset($_GET['codep'])) $filtre=$_GET['codep'];
					else $filtre="";						
					
					if(isset($_GET['id'])) $nom=$_GET['id'];
					else $nom="";	

					$db = new DB();
					if ($nom!="" or $nom!=0){
					$req="SELECT *
						FROM velib 
						WHERE number = $nom
						ORDER BY name";	
					$db->query($req);
					while ($db->fetch_assoc()) {
						echo $db->row['address']; 
					}
					}
					$db->close();
				?> 				
				</div>
				</div>
				
			<div class="panel panel-info">
				
			  <div class="panel-heading">
				 <h3 class="panel-title">Les stations les plus proches</h3>
			  </div>
			  
			  <div class="panel-body">
   			    <form role ="form" method ="GET">
   					<div class ="form-group">
   						<label for="rayon distance">Rayon de recherche </label>
   						<input id ="rayon distance" type ="text" name ="distance" placeholder="Distance en m">
						<button type="submit" class="btn btn-default">Recherche</button>
   					</div>
   				</form>
				   <ul class="list-group">
					   <?php
   						require_once("db.class.php");
						
						if(isset($_GET['id'])) $nom=$_GET['id'];
						else $nom="";	
						
						if ($nom!="" or !$nom=0){
							if (isset($_GET['distance'])) $rayon=$_GET['distance'];
							else $rayon=0 ;
							if ($rayon!=0){
								$db = new DB();
								$req1="select * from velib 
										where number=$nom";
								$db->query($req1);
								while ($db->fetch_assoc()) {
									$lat= $db->row['latitude'];
									$long =  $db->row['longitude'];
								}
								$req2="select * from  
									(select number, name, address,cp, 									 									POW((POW(latitude-$lat,2)+POW(longitude-$long,2)),(1/2))*100 
								as distance from velib order by distance)	as tempo 
								where distance  < $rayon/1000 "; 
								$db->query($req2);
								while ($db->fetch_assoc()){
									echo '<form method="POST" onclick="submit();">' ;
									if (round($db->row["distance"]*1000)>1){
										echo '<li class="list-group-item">';
										echo '<span class="badge">'.round($db->row["distance"]*1000).' m</span>';
										echo '<div class="checkbox">';
										echo '<input name ="markers[]" type ="checkbox" value ='.$db->row['number'].'>'.substr($db->row["name"],8) ; 
										echo '</div>';
										
										echo '</li>';
									}
									echo '</form>';
								}	
							}
						 
						}
						
						#foreach($_POST['markers'] as $i)
						         #echo $i ."\n";
						
						#$db->close();
						
					   ?>
				   </ul>
			  </div>
			  
			  
			</div>
			
			
			</p>
			
		</div>
		
			<div id="map-canvas"/>
			<script>
		 	//var myLatlng2 = new google.maps.LatLng(48.8, 2.3417479951579);
		 	//addMarker(myLatlng2);
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