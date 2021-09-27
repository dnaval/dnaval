<?php
//Start Session 
session_start();

//Get the dbconfig class
include_once './config/dbconfigPDO.php';

//Get the model class
include_once './models/DAN.php';

//Set today's date
date_default_timezone_set('America/Nassau');
$today = date("Y-m-d");
$year = date("Y");

//instantiate db and connect
$bdobject = new dbconfigPDO();
$bdinst = $bdobject->connect();

//instantiate model class
$dncl = new DAN($bdinst);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Daniel Naval</title>
  <meta content="Daniel Naval, Application Support Analyst, Web Developer" name="description">
  <meta content="Daniel Naval, Application Support Analyst, Web Developer" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex flex-column justify-content-center">

    <nav class="nav-menu">
      <ul>
        <li class="active"><a href="#hero"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li><a href="#about"><i class="bx bx-user"></i> <span>About</span></a></li>
        <li><a href="#resume"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
        <li><a href="#portfolio"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
        <li><a href="#contact"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->

  <?php
      $c_arr = $dncl->getContent();
      foreach($c_arr as $cval);

    ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
      <h1>Daniel Naval</h1>
      <p>I'm <span class="typed" data-typed-items=" an Application Support Analyst, a Web Developer"></span></p>
      <div class="social-links">
        <?php if(!empty($cval['twitter'])) { echo '<a href="'.$cval['twitter'].'" class="twitter"><i class="bx bxl-twitter"></i></a>'; } ?>
        <?php if(!empty($cval['facebook'])) { echo '<a href="'.$cval['facebook'].'" class="facebook"><i class="bx bxl-facebook"></i></a>'; } ?>
        <?php if(!empty($cval['instagram'])) { echo '<a href="'.$cval['instagram'].'" class="instagram"><i class="bx bxl-instagram"></i></a>'; } ?>
        <?php if(!empty($cval['skype'])) { echo '<a href="'.$cval['skype'].'" class="google-plus"><i class="bx bxl-skype"></i></a>'; } ?>
        <?php if(!empty($cval['linkedin'])) { echo '<a href="'.$cval['linkedin'].'" class="linkedin"><i class="bx bxl-linkedin"></i></a>'; } ?>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <p></p>
        </div>

        <div class="row">
          <div class="col-lg-12 pt-4 pt-lg-0 content">
            <h3 class="text-center"><?php echo $cval['title']; ?></h3>
            <p class="font-italic text-center">
                     <?php echo $cval['about']; ?>
            </p>
            
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

      <!-- ======= Skills Section ======= -->
     <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Skills</h2>
          <p>
          <?php echo $cval['skills']; ?>
          </p>
        </div>

        <div class="row"> 

            <?php
              $delay=0;
              $skills = $dncl->getSkills();
              foreach($skills as $valsk) {
                  
                  if($delay>=300) {
                    $delay=0;
                  }
 
                    $delay = $delay+100;
                    echo '<div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="'.$delay.'">
                          <div class="icon-box iconbox-blue">
                              <div class="icon">
                                <img width="80" height="80" src="./assets/img/skills/'.$valsk['picture'].'">
                              </div>
                              <h4><a href="">'.$valsk['skills'].'</a></h4>
                              <p>'.$valsk['description'].'</p>
                          </div>
                      </div>';
                  
              }
            
            ?>


        </div>

      </div>
    </section> 
    
   <!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container" data-aos="fade-up">
       
          <?php echo $cval['resume']; ?>

      </div>
    </section><!-- End Resume Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>
               <?php echo $cval['portfolio']; ?>
          </p>
        </div>
        

            <div class="row">
              <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <ul id="portfolio-flters">
                      <li data-filter="*" class="filter-active">All</li>

                  <?php
                        $filters= $dncl->getFilterType();
                        foreach($filters as $filter) {
                  ?>

                      <li data-filter=".<?php echo $filter['filter']; ?>"><?php echo $filter['type']; ?></li>

                  <?php } ?>

                </ul>
              </div>
            </div>

       

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        <?php
              $projs= $dncl->listProjects();
              foreach($projs as $proj) {
                
        ?>
          <div class="col-lg-4 col-md-6 portfolio-item <?php echo $proj['filter']; ?>">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/<?php echo $proj['picture']; ?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><?php echo $proj['project']; ?></h4>
                <p><?php echo $proj['type']; ?></p>
                <div class="portfolio-links">
                 
                  <?php
                     if(!empty($proj['url'])) {
                       $link = $proj['url'];
                     } else {
                       $link = $proj['github'];
                     }
                  ?>
                  <a href="<?php echo $link; ?>" target="_blank" title="URL">View</a> | 
                  <a href="project-details.php?idp=<?php echo $proj['idproject']; ?>" target="_blank" data-gall="portfolioDetailsGallery" data-vbtype="iframe" class="venobox" title="Project Details">Details</a>
               
                </div>
              </div>
            </div>
          </div>

        <?php } ?>


        </div>

      </div>
    </section><!-- End Portfolio Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row mt-1">

          <div class="col-lg-12 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Daniel Naval</h3>
      <p>Every design is a new creation! Ideas are everywhere.</p>
      <div class="social-links">
        <?php if(!empty($cval['twitter'])) { echo '<a href="'.$cval['twitter'].'" class="twitter"><i class="bx bxl-twitter"></i></a>'; } ?>
        <?php if(!empty($cval['facebook'])) { echo '<a href="'.$cval['facebook'].'" class="facebook"><i class="bx bxl-facebook"></i></a>'; } ?>
        <?php if(!empty($cval['instagram'])) { echo '<a href="'.$cval['instagram'].'" class="instagram"><i class="bx bxl-instagram"></i></a>'; } ?>
        <?php if(!empty($cval['skype'])) { echo '<a href="'.$cval['skype'].'" class="google-plus"><i class="bx bxl-skype"></i></a>'; } ?>
        <?php if(!empty($cval['linkedin'])) { echo '<a href="'.$cval['linkedin'].'" class="linkedin"><i class="bx bxl-linkedin"></i></a>'; } ?>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $year; ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">Daniel Naval</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>