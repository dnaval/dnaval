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
           $ids = $fx->sanitizeItem($_POST['sid'], 'int');
           $name = $fx->sanitizeItem($_POST['skill'], 'string');

           if(isset($_FILES['pic']['name']) && ($_FILES['pic']['name'] != null)) {
                $pic_sk = $_FILES['pic']['name'];

                //File uploaded
                $tname_emp = $_FILES['pic']['tmp_name'];
                $resupload = $fx->dn_uploadskill($tname_emp,$pic_sk);
           } else {
                $pic_sk = $fx->sanitizeItem($_POST['picture'], 'string');
           }
               
           $SKValue = array(
           'skills' => $name,
           'description' => '',
           'picture' => $pic_sk,
           'idskills' => $ids
           );
       
           //Edit skill
           $rexec = $dncl->editSkills($SKValue);
   
   
           if($rexec==1) {
           $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>Skill is updated!</div>';
           } else {
           $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>Skill is not updated!</div>'; 
           }
   
   
           //Rediriect the page to the current page
           header('Location: ../index.php?dan=skills');
   
    } else {
        // Reset token
        unset($_SESSION["csrf_token"]);
        $_SESSION['msg'] = '<div class="alert alert-danger">CSRF token validation failed!</div>';
        ob_start();
        header("Location: ../index.php?dan=skills");
        ob_end_flush();
        ob_end_clean();
    }
}