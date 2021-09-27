<?php
//FX Class
require './lib/dnfunctions.php';
$fx = new dnfunctions();

//Get the dbconfig class
include_once '../config/dbconfigPDO.php';

//Get the model class
include_once '../models/DAN.php';

//instantiate db and connect
$bdobject = new dbconfigPDO();
$bdinst = $bdobject->connect();

//instantiate model class
$dncl = new DAN($bdinst);

?>


<div class="container dn-border">
 
    <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <br/>

    <h1>
        <span>Website Content</span>
    </h1>
    
    <?php
       $resultReq = $dncl->getContent();
       if($resultReq) {  
           foreach($resultReq as $key => $val) { 
    ?>

    <form class="row g-3" action="./actions/contentAction.php" method="post" enctype= multipart/form-data>
         <div class="col-md-12">
            <label class="form-label">Twitter</label>
            <input type="text" class="form-control" name="twit" value="<?php echo $val['twitter']; ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">Facebook</label>
            <input type="text" class="form-control" name="face" value="<?php echo $val['facebook']; ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">Instagram</label>
            <input type="text" class="form-control" name="insta" value="<?php echo $val['instagram']; ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">Skype</label>
            <input type="text" class="form-control" name="sky" value="<?php echo $val['skype']; ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">Linkedin</label>
            <input type="text" class="form-control" name="link" value="<?php echo $val['linkedin']; ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="tit" value="<?php echo $val['title']; ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">About</label>
            <textarea id="dntextarea" name="about" class="form-control"><?php echo $val['about']; ?></textarea>
        </div>
        
        <div class="col-md-12">
            <label class="form-label">Skills</label>
            <textarea id="dntextarea" name="skills" class="form-control"><?php echo $val['skills']; ?></textarea>
        </div>

        <div class="col-md-12">
            <label class="form-label">Resume</label>
            <textarea id="dntextarea" name="resume" class="form-control"><?php echo $val['resume']; ?></textarea>
        </div>

        <div class="col-md-12">
            <label class="form-label">Portfolio</label>
            <textarea id="dntextarea" name="portfolio" class="form-control"><?php echo $val['portfolio']; ?></textarea>
        </div>
        

        <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>   

    </form>
    <?php
           }

        }
    ?>

</div>
