<?php
include_once 'db_connect.php';
include_once 'functions.php';
#sec_session_start(); 
$user = $_SESSION['username'];
if($stmt=$mysqli->prepare("SELECT * from musee as musee INNER JOIN (select id_musee from musee_favorite as musee
INNER JOIN (select id as id_user from members where username=?) as user
on (musee.id_user=user.id_user)) as musee_favo on (musee.id_musee=musee_favo.id_musee)")){
        $stmt->bind_param('s', $user);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $result = $stmt->get_result() ; 
	    while ($myrow = $result->fetch_assoc()) {
			echo ' <tr>'; 
			echo ' <td><a href="voir_musee.php?id='.$myrow['id_musee'].'&codep='.$myrow['cp'].'"</a>'.$myrow['nom_du_musee'].'</td>';
			echo ' <td>'.$myrow['adresse'].', '.$myrow['cp'].', '. $myrow['ville'].'</td>';
			echo '</tr>' ;
	     }
        }
?>