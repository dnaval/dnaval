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

//Today's date also set timezone
date_default_timezone_set('America/Nassau');
$today = date("Y-m-d H:i:s");  
$year = date("Y"); 


//Check token
if (!empty($_POST["csrf_token"])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

        //Get value from form
        $pname = $fx->sanitizeItem($_POST['pname'], 'string');
        $desc = $_POST['desc'];
        $cat = $fx->sanitizeItem($_POST['catego'], 'string');
        $company = $fx->sanitizeItem($_POST['comp'], 'string');
        $pdate = $fx->sanitizeDate($_POST['pdate']);
        $url = $fx->sanitizeItem($_POST['url'], 'url');
        $github = $fx->sanitizeItem($_POST['git'], 'url');
        $idtyp = $fx->sanitizeItem($_POST['typid'], 'int');
        $pid = $fx->sanitizeItem($_POST['pid'], 'int');
        
        //For PNG imae
        if(isset($_FILES['picpng']['name']) && ($_FILES['picpng']['name'] != null)) {
            $pic_pj = $_FILES['picpng']['name'];

            //File uploaded
            $tname_pj = $_FILES['picpng']['tmp_name'];
            $resupload = $fx->dn_uploadproject($tname_pj,$pic_pj);
        } else {
                $pic_pj = $fx->sanitizeItem($_POST['picg'], 'string');
        }

         //For GIG imae
         if(isset($_FILES['picgif']['name']) && ($_FILES['picgif']['name'] != null)) {
             $pic_pjz = $_FILES['picgif']['name'];

            //File uploaded
            $tname_pjz = $_FILES['picgif']['tmp_name'];
            $resuploadz = $fx->dn_uploadproject($tname_pjz,$pic_pjz);
        } else {
                $pic_pjz = $fx->sanitizeItem($_POST['picf'], 'string');
        }
            
        $PJValue = array(
        'project' => $pname,
        'description' => $desc,
        'category' => $cat,
        'company' => $company,
        'projectdate' => $pdate,
        'url' => $url,
        'github' => $github,
        'picture' => $pic_pj,
        'gif' => $pic_pjz,
        'idtype' => $idtyp,
        'idproject' => $pid
        );
    
        //add user
        $rexec = $dncl->editProject($PJValue);


        if($rexec==1) {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>Project is updated!</div>';
        } else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>Project is not updated!</div>'; 
        }


        //Rediriect the page to the current page
        header('Location: ../index.php?dan=projects');

    } else {
        // Reset token
        unset($_SESSION["csrf_token"]);
        $_SESSION['msg'] = '<div class="alert alert-danger">CSRF token validation failed!</div>';
        ob_start();
           header("Location: ../index.php?dan=projects");
        ob_end_flush();
        ob_end_clean();
    }
}