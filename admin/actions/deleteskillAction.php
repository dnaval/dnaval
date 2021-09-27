<?php
//Start Session 
session_start();

//Get the dbconfig class
include_once '../../config/dbconfigPDO.php';

//Get the model class
include_once '../../models/DAN.php';

//instantiate db and connect
$bdobject = new dbconfigPDO();
$bdinst = $bdobject->connect();

//instantiate model class
$dncl = new DAN($bdinst);

if(isset($_GET['ID'])) {
    //Delete User
    $sup = $dncl->deleteSkills($_GET['ID']);
    
    if($sup==1) {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>Skill is removed!</div>';
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>Skill is not removed!</div>'; 
    }
}

//Rediriect the page to the current page
header('Location: ../index.php?dan=skills');