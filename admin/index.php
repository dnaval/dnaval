<?php
//Start Session 
session_start();

//Include IndexController page
require_once './controllers/IndexController.php';

//DBController Class
require './models/DBController.php';

//FX Class
require './lib/zenfx.php';
$zx = new zenfx();

//Set today's date
date_default_timezone_set('America/Nassau');
$today = date("Y-m-d");
$year = date("Y");

if(isset($_GET['dan'])) {
  $page = $_GET['dan'];
} else {
  $page = '';
}
$navact = $zx->navActive($page);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daniel Naval - Admin</title>
    <meta content="Daniel Naval, Application Support Analyst, Web Developer" name="description">
    <meta content="Daniel Naval, Application Support Analyst, Web Developer" name="keywords">

    <!-- Favicons -->
    <link href="./images/favicon.png" rel="icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="./css/dnaval.css">

    <style>
   
    </style>


  </head>
  <body>

  <?php if(isset($_SESSION['UID']) && isset($_SESSION['username'])) { ?>
      <nav class="navbar navbar-expand-sm navbar-light bg-dnaval">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="./images/Naval_Daniel_Logo.png" alt="Naval Daniel Logo">  
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link <?php echo $navact['nav1']; ?>" href="index.php?dan=home">Home</a>
              <a class="nav-link <?php echo $navact['nav2']; ?>" href="index.php?dan=content">Content</a>
              <a class="nav-link <?php echo $navact['nav3']; ?>" href="index.php?dan=skills">Skills</a>
              <a class="nav-link <?php echo $navact['nav4']; ?>" href="index.php?dan=projects">Projects</a>
              <a class="nav-link <?php echo $navact['nav5']; ?>" href="index.php?dan=users">Users</a>
            </div>
          </div>

          <div class="d-flex">   
                <i class="fa fa-user fa-dn" aria-hidden="true"></i> &nbsp;
                <?php echo $_SESSION['username']; ?>
                &nbsp; | &nbsp;
                <i class="fa fa-lock fa-dn" aria-hidden="true"></i> &nbsp;
                <a href="./logout.php">Logout</a>
          </div>

        </div>
      </nav>
  <?php } ?>
  <br/>


     <!-- CONTENT -->
        <?php
        //Check the variable
        if(isset($_GET['dan'])) {
            $page = $_GET['dan'];
        } else {
            $page='';
        }

        if(isset($_SESSION['UID'])) {
            $UID = $_SESSION['UID'];
        } else {
            $UID='';
        }

        //Instantiate Controller
        $index = new IndexController();

        //Display Page
        $index->displayPage($page,$UID);
        ?>     
      <!-- END CONTENT -->


    <?php if(isset($_SESSION['UID']) && isset($_SESSION['username'])) { ?>
      <!-- Footer -->
      <footer class="mt-auto text-center text-lg-start bg-dnaval text-muted">
          <!-- Copyright -->
          <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © <?php echo $year; ?> Copyright 
            <a class="text-reset fw-bold" href="https://www.linkedin.com/in/daniel-naval-a4a81551/?lipi=urn%3Ali%3Apage%3Ad_flagship3_feed%3BBeYqnQ5jQye%2B4%2BpqnVH11g%3D%3D">Daniel Naval</a>
          </div>
          <!-- Copyright -->
      </footer>
      <!-- Footer -->
    <?php } ?>

    <!--  JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!--  Tiny WYSIWYG -->
    <script src="https://cdn.tiny.cloud/1/crmxn8is21nr42j5pxakd1najdts1sy8keh4ikmav02k4gm1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
          toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
          toolbar_mode: 'floating',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
      });
    </script>

  </body>
</html>