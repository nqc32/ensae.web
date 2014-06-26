<?php

require_once("db.class.php");





function ConnectedUser()
{       
        $db = new DB;
        $queryfind = "SELECT identifiant
                     FROM individu
                     WHERE mail = '$_POST[email]' " ;

         if($db->query($queryfind)){
         while ($db->fetch_assoc()) {
          $id=$db->row['identifiant'];
	  header( "refresh:2;url=Pageperso.php?identifiant=".$id." ");
	  echo "Connexion reussie :)!!<br> <br> <br> Vous allez être redirigé vers votre page perso dans quelques secondes..." ;
          }
         }
        else{
        echo "Erreur : Bug !";
        }
}

function SignIn()
{

if(!empty($_POST['email']) && !empty($_POST['mdp']) )   
{     
 
	$query = "SELECT * 
                 FROM individu
                 WHERE mail = '$_POST[email]' AND  mdp= '$_POST[mdp]'" ;
        $db = new DB;
        if ($db->query($query)) {
	if($row = $db->fetch_assoc() )
	{       

		ConnectedUser();
	}
	else
	{
		echo "Mauvais mot de passe ou adresse mail";
	}

}
else{
echo "Mauvais mot de passe ou adresse mail";
}
}
else{
     echo "Remplir tous les champs";
}

}


if(isset($_POST['submit']))
{ 
  SignIn();
}

?>

