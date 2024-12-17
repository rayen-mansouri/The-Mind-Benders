<?php
 include_once '../../Controller/UserC.php';
 $co = new userC();
 if(isset($_GET['id'])){
     $co->SupprimerAdmin($_GET['id']);
 
    header('Location:affichageUser.php');
    }

 ?>