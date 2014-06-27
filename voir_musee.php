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
    <title>Visualiser les musées de Paris</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
	
	
		    <style type="text/css">
		         html { height: 100% }
		         body { height: 65%; margin: 0; padding: 0 }
		         #map-canvas { height: 100% }
		     </style>
		       
			 <script type="text/javascript"
		         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4NInl2ygUk82FWxXwjUFQ9LFX9RR0V9o">
		     </script>	  
			 
			 <?php
			 #require_once("db.class.php");
	 		 if(isset($_GET['id'])) $musee=substr($_GET['id'],0,5);
	 		 else $musee="";
			 $db = new DB();
			 if ($musee!="") {
				$req="SELECT *
				FROM musee
				WHERE id_musee= $musee
				ORDER BY id_musee";
				$db->query($req);
				while ($db->fetch_assoc()) {
					$lat=$db->row['latitude'] ;
					$long=$db->row['longitude'] ;
					$id_musee = $db->row['id_musee'] ;
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
			 var number = '<?php echo $id_musee; ?>' 
		   	 var position2=new google.maps.LatLng(latitude, longtitude) ; // position du point indiqué
			 /*var image = {
			     url: 'images/museum-256.png',
			     // This marker is 20 pixels wide by 32 pixels tall.
			     size: new google.maps.Size(20, 32),
			     // The origin for this image is 0,0.
			     origin: new google.maps.Point(0,0),
			     // The anchor for this image is the base of the flagpole at 0,32.
			     anchor: new google.maps.Point(0, 32)
			   };*/
				 var image = 'images/pin.png';
			   // Shapes define the clickable region of the icon.
			   // The type defines an HTML &lt;area&gt; element 'poly' which
			   // traces out a polygon as a series of X,Y points. The final
			   // coordinate closes the poly by connecting to the first
			   // coordinate.
			   /*var shape = {
			       coords: [1, 1, 1, 20, 18, 20, 18 , 1],
			       type: 'poly'
			   };*/
			 function Markers(number){
			 	if (document.getElementById(number).checked==false) {
			 		for (var i=0; i<markers.length;i++){
			 			if (markers[i].getTitle()==number) {
			 				markers[i].setVisible(false) ;
			 			}	
			 		}
			 	} else {
					for (var i=0; i<markers.length;i++){
			 			if (markers[i].getTitle()==number) {
			 				markers[i].setVisible(true) ;
							markers[i].setMap(map);
			 			}	
			 		}
					
				}
			 }
			 
			 
			 function initialize() {
			   var paris = new google.maps.LatLng(48.857091635218, 2.3417479951579);
			   var mapOptions = {
			     zoom: 13,
			     center: paris,
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
  			 	#require_once("db.class.php");
  	 			if(isset($_GET['codep']) and ($_GET['id']==0)) $codepostal=$_GET['codep'];
  	 			else $codepostal="";
  				$db = new DB();
  				if ($codepostal!="") { //si le code postal est passé en argument
  					$req="SELECT *
  						FROM musee
  						WHERE cp= $codepostal
  						ORDER BY id_musee";
  					$db->query($req);
  					while ($db->fetch_assoc()) { // placer tous les points situés dans la zone
  						$lat =$db->row['latitude'] ;
  						$long=$db->row['longitude'] ;
						#$info =$db->row['name'] ;
						echo "var position = new google.maps.LatLng(".$lat.",".$long.");" ;
						echo "addMarker_info(position);" ;  
  					} ;
					echo "map.setCenter(position)";
  				}
				else {
					if (isset($_GET['id'])){
					echo "addMarker_info(position2,number);";
					echo "map.setCenter(position2);";
					echo "map.setZoom(15);";
					}
				};  // si non, placer seulement le point indiqué
  				#else echo "addMarker(position2);";
				$db->close();
			   	?>
			   //markers.setMap(map);
			   
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
			 
			 function addMarker_latlng(lat,long,info){
				var location =	new google.maps.LatLng(lat, long);
		 		/*var exist = true ; 
				for (var i=0; i<markers.length;i++){
		 			if (markers[i].getTitle()==info) {
		 				exist = false ;
		 			}	
				if (exist){*/
				var titre =  String(info) ;
  			   		var marker = new google.maps.Marker({
  			     		position: location,
  			     		map: map,
  				 		title : titre
						//icon : image
  			   		});
  			   	 	markers.push(marker); 
					//markers.setMap(map);
					//}
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

		     //<![CDATA[
			 
			 
		 	
		   //]]> 
			 
			 google.maps.event.addDomListener(window, 'load', initialize);

		     </script>
			
 </head>

<body >
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
                echo '<li class="active"><a href="voir_musee.php">'.$page3.'</a></li>';
  			 ?>
                 <!--<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Visualiser <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="voir_carte.php">Station Vélib''</a></li>
                    <li class="divider"></li>
                    <li><a href="voir_musee.php">Musée</a></li>

                  </ul> <!-->
                </li>
              </ul>
          	  <ul class="nav navbar-nav navbar-right" >
			  <li><a href="connexion.php">Espace Personnel</a></li>
			  <?php
			  if (login_check($mysqli) == true){
				  echo '<li><a href="includes/logout.php">Déconnexion en tant que <strong>'.$_SESSION['username'].'</strong></a></li>';
			  }	
			  ?>
	  		  </ul>
            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
      </div>

        <!-- Main component for a primary marketing message or call to action -->
      <div class="bs-example" style="font-size:small;">
          <h2>Musée en région Parisienne</h2>
  		<!-- Début Formulaire -->
			<form id="code_postal" role="select" method="GET" >
				<div class="form-group">
					<label for="code postal">Sélectionner le code postal </label>
  		    		<select id="code postal" type="number" name="codep" class="form-control" onchange="submit();return false;">
						<option VALUE=0></option>
						<?php
						if(isset($_GET['codep'])) $remplie=$_GET['codep'] ;
						else $remplie="";
						
						if (isset($_GET['id'])) $musee_id = $_GET['id'];
						else $musee_id="";
						#if ($remplie!=""){
						#	echo '<option selected="selected">'.$remplie.'</option>';
						#}
						#require_once("db.class.php");
						$db = new DB();
						if (($musee_id!=0 or $musee_id!="") and ($remplie==0 or $remplie=="")){
							$req0="SELECT * from musee
								where id_musee=$musee_id";
							$db->query($req0);
							while ($db->fetch_assoc()){
								$remplie=$db->row['cp'];
							}
						}
						$req="SELECT distinct cp
								FROM musee
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
					<label for="station velib">Liste des musées </label>
  		    		<select id="station velib" name="id" class="form-control" onclick="submit();return false">
						<option VALUE=0>Toutes les stations</option>
						<?php
						#require_once("db.class.php");
						
						if(isset($_GET['codep'])) $filtre=$_GET['codep'];
						else $filtre="";						
							
						if(isset($_GET['id'])) $nom=$_GET['id'];
						else $nom="";	
						
						
						$db = new DB();
						if ($filtre!=""){
						$req="SELECT *
							FROM musee 
							WHERE cp = $filtre
							ORDER BY id_musee";	
						$db->query($req);
						while ($db->fetch_assoc()) {
							if ($db->row['id_musee']!=$nom){
								echo '<option VALUE ='.$db->row['id_musee'].'>'.$db->row['nom_du_musee'].'</option>'; }
							else {
								echo '<option selected VALUE='.$db->row['id_musee'].'>'.$db->row['nom_du_musee'] .'</option>';}
						}
						}
						$db->close();
						?>
					</select>
				</div>
  			</form>
	  </div>
	  <div class="bs-docs-section" style="float:left;max-width:360px;">
			<div class="panel panel-primary" style="float:left;width:300px;">
				 <div class="panel-heading">
					 <h4 class="panel-title">Information</h4>
			   	</div>
				<div class="panel-body">
					<ul class="list-group">
				<?php
					#require_once("db.class.php");
				
					if(isset($_GET['codep'])) $filtre=$_GET['codep'];
					else $filtre="";						
					
					if(isset($_GET['id'])) $nom=$_GET['id'];
					else $nom="";	

					$db = new DB();
					if ($nom!="" or $nom!=0){
					$req="SELECT *
						FROM musee
						WHERE id_musee = $nom
						ORDER BY nom_du_musee";	
					$db->query($req);
					while ($db->fetch_assoc()) {
						echo '<li class="list-group-item"> <strong>'.$db->row['nom_du_musee'].'</strong></li>';
						echo '<li class="list-group-item"> <strong>Adresse </strong>: '.$db->row['adresse'].', '.$db->row['cp'].' '.$db->row['ville'].'</li>';
						echo '<li class="list-group-item"> <strong>Ouverture</strong>: '.$db->row['periode_ouverture'].'</li>';
						echo '<li class="list-group-item"> <strong>Site Web</strong>: <a href=http://'.$db->row['sitweb'].'>'.$db->row['sitweb'].'</a></li>';
						
					}
					}
					$db->close();
				?> 		
					</ul>
				</div>
			</div>
			<div class="panel panel-success" style="float:left;width:300px;">
			  <div class="panel-heading">
				 <h4 class="panel-title">Les stations les plus proches</h4>
			  </div>
			  <div class="panel-body">
   			    <form role ="form" method ="POST">
   					<div class ="form-group">
   						<label for="rayon distance">Rayon de recherche </label>
   						<input id ="rayon distance" type ="text" name ="distance" placeholder="Distance en m">
						<button type="submit" class="btn btn-default">Recherche</button>
   					</div>
   				</form>
				   <ul class="nav nav-pills">
					   <?php
   						#require_once("db.class.php");
						
						if(isset($_GET['id'])) $nom=$_GET['id'];
						else $nom="";	
						
						if ($nom!="" or !$nom=0){
							if (isset($_POST['distance'])) $rayon=$_POST['distance'];
							else $rayon=0 ;
							if ($rayon!=0){
								$db = new DB();
								$req1="select * from musee
										where id_musee=$nom";
								$db->query($req1);
								while ($db->fetch_assoc()) {
									$lat= $db->row['latitude'];
									$long =  $db->row['longitude'];
								}
								$req2="select * from  
									(select number, name, address,cp, longitude,latitude,									 									POW((POW(latitude-$lat,2)+POW(longitude-$long,2)),(1/2))*100 
								as distance from velib order by distance)	as tempo 
								where distance  < $rayon/1000 "; 
								$db->query($req2);
								while ($db->fetch_assoc()){
									echo '<form action>' ;
									if (round($db->row["distance"]*1000)>1){
										echo '<script>';
										echo 'addMarker_latlng('.$db->row["latitude"].','.$db->row["longitude"].','.$db->row["number"].');';
										echo '</script>';
										echo '<li>';
										echo '<div class="checkbox">';
										echo '<input id='.$db->row['number'].' type ="checkbox"  onclick="Markers('.$db->row['number'].')"><a href="voir_carte.php?'.'codep='.$_GET['codep'].'&id='.$db->row['number'].'">'.substr($db->row["name"],8).'<span class="badge pull-right">'.round($db->row["distance"]*1000).' m</span></a></input>' ; 
										echo '</div>';
																				
										echo '</li>';
									}
									echo '</form>';
								}	
							}
						 
						}
						#$db->close();
					   ?>
				   </ul>
			  </div>
			  
			  
			</div>
			<div class="panel panel-info" style="float:left;width:300px;">
				 <div class="panel-heading">
					 <h4 class="panel-title">Liste des musées aux alentours</h4>
			   	 </div>
				 <div class="panel-body">
	   			    <form role ="form" method ="POST">
	   					<div class ="form-group">
	   						<label for="rayon distance">Rayon de recherche </label>
	   						<input id ="rayon distance" type ="text" name ="distance_musee" placeholder="Distance musee en m">
							<button type="submit" class="btn btn-default">Recherche</button>
	   					</div>
	   				</form>
					   <ul class="nav nav-pills">
						   <?php
	   						#require_once("db.class.php");
						
							if(isset($_GET['id'])) $nom=$_GET['id'];
							else $nom="";	
						
							if ($nom!="" or !$nom=0){
								if (isset($_POST['distance_musee'])) $rayon_musee=$_POST['distance_musee'];
								else $rayon_musee=0 ;
								if ($rayon_musee!=0){
									$db = new DB();
									$req1="select * from musee 
											where id_musee=$nom";
									$db->query($req1);
									while ($db->fetch_assoc()) {
										$lat= $db->row['latitude'];
										$long =  $db->row['longitude'];
									}
									$req2="select * from  
										(select id_musee, nom_du_musee,latitude, longitude, POW ( (POW(latitude-$lat,2)+POW(longitude-$long,2)),(1/2))*100 	
as distance from musee order by distance )	as tempo 
									where distance  < $rayon_musee/1000 "; 
									$db->query($req2);
									while ($db->fetch_assoc()){
										echo '<form action>' ;
										if (round($db->row["distance"]*1000)>1){
											#echo $db->row["nom_du_musee"] ;
											echo '<script>';
											echo 'addMarker_latlng('.$db->row["latitude"].','.$db->row["longitude"].','.$db->row["id_musee"].');';
											echo '</script>';
											echo '<li>';
											echo '<div class="checkbox">';
											echo '<input id='.$db->row['id_musee'].' type ="checkbox"  onclick="Markers('.$db->row['id_musee'].')"><a href="voir_musee.php?id='.$db->row['id_musee'].'">'.$db->row["nom_du_musee"].'<span class="badge pull-right">'.round($db->row["distance"]*1000).' m</span></a></input>' ; 
											echo '</div>';
																				
											echo '</li>';
										}
										echo '</form>';
									}	
								}
						 
							}
							#$db->close();
						   ?>
					   </ul>
				 </div>	
	  	    </div>
	  </div>	
	  <div id="map-canvas"/>
			<!--<div id="map" style="width: 640px; height: 500px; padding:-5px;"></div>-->
			
			<script>
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