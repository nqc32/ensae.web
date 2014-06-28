<?php
include_once 'db_connect.php';
include_once 'functions.php';
#sec_session_start(); 
$user = $_SESSION['username'];
if($stmt=$mysqli->prepare("SELECT * from velib as velib INNER JOIN (select id_velib from velib_favorite as velib 
INNER JOIN (select id as id_user from members where username=?) as user
on (velib.id_user=user.id_user)) as velib_favo on (velib.number=velib_favo.id_velib)")){
        $stmt->bind_param('s', $user);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $result = $stmt->get_result() ; 
	    while ($myrow = $result->fetch_assoc()) {
			echo ' <tr>'; 
			echo ' <td><a href="voir_carte.php?id='.$myrow['number'].'&codep='.$myrow['cp'].'"</a>'.$myrow['name'].'</td>';
			echo ' <td>'.$myrow['address'].'</td>';
			
			echo '</tr>' ;
	     }
        }
?>