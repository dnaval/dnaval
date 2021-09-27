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

//FX Class
require '../lib/dnfunctions.php';
$fx = new dnfunctions();

//Check token
if (!empty($_POST["csrf_token"])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

           //Get value from form
           $idt = $fx->sanitizeItem($_POST['tid'], 'int');
           $tname = $fx->sanitizeItem($_POST['type'], 'string');
          $tfilter = $_POST['filt'];
               
           $SKValue = array(
           'type' => $tname,
           'filter' => $tfilter,
           'idtype' => $idt
           );
       
           //Edit skill
           $rexec = $dncl->editType($SKValue);
   
   
           if($rexec==1) {
           $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>Project type is updated!</div>';
           } else {
           $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>Project type is not updated!</div>'; 
           }
   
   
           //Rediriect the page to the current page
           header('Location: ../index.php?dan=projecttype');
   
    } else {
        // Reset token
        unset($_SESSION["csrf_token"]);
        $_SESSION['msg'] = '<div class="alert alert-danger">CSRF token validation failed!</div>';
        ob_start();
        header("Location: ../index.php?dan=projecttype");
        ob_end_flush();
        ob_end_clean();
    }
}