<?php

require_once("db.class.php");





function NewUser()
{       
        $db = new DB;
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$mdp =  $_POST['mdp'];
        $villes=$_POST['villes'];
        $rayon= $_POST['Rayonactions'];
	$query = "INSERT INTO individu (nom,prenom,Villes,rayon_action,mail,mdp) VALUES ('$nom','$prenom','$villes','$rayon','$email','$mdp')";
        $queryfind = "SELECT identifiant
                 FROM individu
                 WHERE mail = '$_POST[email]' " ;
	if($db->query($query))
	{
         if($db->query($queryfind)){
         while ($db->fetch_assoc()) {
          $id=$db->row['identifiant'];
	  header( "refresh:2;url=Pageperso.php?identifiant=".$id." ");
	  echo "Creation de compte reussi :)!!<br> <br> <br> Vous allez être redirigé vers votre page perso dans quelques secondes..." ;
          }
         }
	}
        else{
        echo "Houston";
        }
}

function SignUp()
{

if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['villes']) && !empty($_POST['Rayonactions']))   
{     

	$query = "SELECT * 
                 FROM individu
                 WHERE mail = '$_POST[email]' " ;
        $db = new DB;
        if ($db->query($query)) {
	if(!$row = $db->fetch_assoc() )
	{       

		NewUser();
	}
	else
	{
		echo "Vous ne pouvez avoir qu'un compte par adresse mail";
	}
}

}
else{
     echo "Remplir tous les champs";
}

}

if(isset($_POST['submit']))
{
	SignUp();
}
?>

