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
        $twitter = $_POST['twit'];
        $facebook = $_POST['face'];
        $instagram = $_POST['insta'];
        $skype = $_POST['sky'];
        $linkedin = $_POST['link'];
        $title = $_POST['tit'];
        $about = $_POST['about'];
        $skills = $_POST['skills'];
        $resume = $_POST['resume'];
        $portfolio = $_POST['portfolio'];
        
        
            
        $CValue = array(
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'skype' => $skype,
            'linkedin' => $linkedin,
            'title' => $title,
            'about' => $about,
            'skills' => $skills,
            'resume' => $resume,
            'portfolio' => $portfolio 
        );

        //add or update content
        $rexec = $dncl->putContent($CValue);


        if($rexec==1) {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><strong>Well done! </strong>Content is updated!</div>';
        } else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-mg-b" role="alert"><strong>Error: </strong>Content is not updated!</div>'; 
        }


        //Rediriect the page to the current page
        header('Location: ../index.php?dan=content');

    } else {
        // Reset token
        unset($_SESSION["csrf_token"]);
        $_SESSION['msg'] = '<div class="alert alert-danger">CSRF token validation failed!</div>';
        ob_start();
           header("Location: ../index.php?dan=content");
        ob_end_flush();
        ob_end_clean();
    }
}