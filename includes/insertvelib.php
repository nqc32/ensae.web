<?php
include_once 'db_connect.php';
include_once 'functions.php';
#sec_session_start(); 
$user = $_SESSION['username'];
$id_velib=$_GET['id_velib'];

if($stmt=$mysqli->prepare("SELECT id
        FROM members
       	WHERE username = ?
        LIMIT 1")){
        $stmt->bind_param('s', $user);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt1=$mysqli
		$query=mysql_query("INSERT INTO `secure_login`.`velib_favorite` (`id_user`, `id_velib`) VALUES ('8', '22042'");)
		}

?>