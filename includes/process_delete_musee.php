<?php
include_once 'db_connect.php';
include_once 'functions.php';
if(isset($_GET['user_id'],$_GET['musee_id'])){
	
    $user_id = $_GET['user_id'];
    $musee_id = $_GET['musee_id'];
	$codep= $_GET['codep'];
	$del_query = "DELETE FROM musee_favorite WHERE(id_user=$user_id AND 										id_musee=$musee_id)";
	$mysqli->query($del_query);
			#echo "<script>javascript: alert('Station ajoutée dans les favoris')></script>";
	header('Location: ../voir_musee.php?codep='.$codep.'&id='.$musee_id);
	#} else{
	#		header('Location: ../voir_carte.php?codep='.$codep.'&id='.$musee_id.'&error=1');
			#echo "<script>javascript: alert('Insert Error musee_favorite')></script>";
			#}
}
?>