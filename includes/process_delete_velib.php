<?php
include_once 'db_connect.php';
include_once 'functions.php';
if(isset($_GET['user_id'],$_GET['velib_id'])){
	
    $user_id = $_GET['user_id'];
    $velib_id = $_GET['velib_id'];
	$codep= $_GET['codep'];
	$header=$_GET['header'];
	$del_query = "DELETE FROM velib_favorite WHERE(id_user=$user_id AND 										id_velib=$velib_id)";
	$mysqli->query($del_query);
			#echo "<script>javascript: alert('Station ajoutée dans les favoris')></script>";
	header($header.'codep='.$_GET['codep'].'&id='.$_GET['velib_id']);
	#} else{
	#		header('Location: ../voir_carte.php?codep='.$codep.'&id='.$velib_id.'&error=1');
			#echo "<script>javascript: alert('Insert Error velib_favorite')></script>";
			#}
}
?>