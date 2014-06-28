<?php
include_once 'db_connect.php';
include_once 'functions.php';
if(isset($_GET['user_id'],$_GET['musee_id'])){
	
    $user_id = $_GET['user_id'];
    $musee_id = $_GET['musee_id'];
	$codep= $_GET['codep'];
	#$code =$_GET['codep']; // The hashed password.
    if ($insert_stmt = $mysqli->prepare("INSERT INTO musee_favorite (id_user, id_musee) VALUES (?, ?)")) {
        $insert_stmt->bind_param('ss', $user_id, $musee_id);
        // Execute the prepared query.
        if ($insert_stmt->execute()) {
			#echo "<script>javascript: alert('Station ajoutée dans les favoris')></script>";
			header('Location: ../voir_musee.php?codep='.$codep.'&id='.$musee_id);
        } else 
			
		{
			header('Location: ../voir_musee.php?codep='.$codep.'&id='.$musee_id.'&error=1');
			#echo "<script>javascript: alert('Insert Error velib_favorite')></script>";
		}
    }

}
?>