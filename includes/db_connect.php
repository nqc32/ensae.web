<?php
include_once 'psl-config.php';   // As functions.php is not included

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->set_charset("utf8")) {
    #printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", mysqli_error($this->link));
} else {
    #printf("Jeu de caractères courant : %s\n", mysqli_character_set_name($this->link));
}
?>