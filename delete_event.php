<?php
include_once __DIR__ . '/../../../Controller/event_con.php';

// Création d'une instance du contrôleur des événements
$eventC = new eventCon("event");

if (isset($_GET['id'])){
    $current_id = $_GET['id']; 

    $res = $eventC->deleteEvent($current_id);// condition si vrai  va supprimer loffre de id snn error 

    if ($res){
        header('Location: ../../../view/back/gestion events/gestion events.php');
        exit();
    }
    else{
        header('Location: ../../../view/back/gestion events/gestion events.php');
        exit();
    }
}
else{
    header('Location: ../../../view/back/gestion events/gestion events.php');
    exit();
}


?>  