<?php
include '../controller/conseilC.php';


$c = new conseilC();
$c->supprimer($_GET["id_con"]);
header('Location:afficherconseil.php');


?>