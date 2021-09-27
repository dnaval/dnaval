<?php
//Get the dbconfig class
include_once '../config/dbconfigPDO.php';

//Get the model class
include_once '../models/DAN.php';

//instantiate db and connect
$bdobject = new dbconfigPDO();
$bdinst = $bdobject->connect();

//instantiate model class
$dncl = new DAN($bdinst);

$su = $dncl->statUsers();
$ss = $dncl->statSkills();
$sp = $dncl->statProject();

?>


<div class="container dn-border">


        <br/>   

        <h1> <span>Welcome to DNAVAL</span></h1>
        <hr/>


          <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
              <div class="feature-icon bg-primary bg-gradient">
                    
              </div>
              <h2><i class="fa fa-users" aria-hidden="true"></i></h2>
              <h4><?php echo $su; ?> User</h4>
              
            </div>

            <div class="feature col">
              <div class="feature-icon bg-primary bg-gradient">
                    
              </div>
              <h2><i class="fa fa-wrench" aria-hidden="true"></i></h2>
              <h4><?php echo $ss; ?> Skills</h4>
              
            </div>
            <div class="feature col">
              <div class="feature-icon bg-primary bg-gradient">
                    
              </div>
              <h2><i class="fa fa-folder" aria-hidden="true"></i></h2>
              <h4><?php echo $sp; ?> Projects</h4>
              
            </div>

            </div>

  </div>
