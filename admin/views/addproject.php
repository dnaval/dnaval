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
        <span>Add project</span>
        <a href="./index.php?dan=projects"><button class='btn btn-secondary float-end'>Projects list</button></a>
    </h1>

    <form class="row g-3" action="./actions/addprojectAction.php" method="post" enctype= multipart/form-data>
         <div class="col-md-12">
            <label class="form-label">Project Name</label>
            <input type="text" class="form-control" name="pname">
        </div>
        <div class="col-md-12">
            <label class="form-label">Description</label>
            <textarea id="dntextarea" name="desc" class="form-control"></textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">Category</label>
            <input type="text" class="form-control" id="inputEmail4" name="catego">
        </div>
        <div class="col-md-6">
            <label class="form-label">Project Type</label>
            <select class="form-select" name="typid">
            <option value="">Choose a project type</option>
            <?php
                $resd = $dncl->getFilterType();
                if($resd) {
                    foreach($resd as $keyd => $vald) {
                    echo '<option value="'.$vald['idtype'].'">'.$vald['type'].'</option>';
                    }
                }
            ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Client / Company</label>
            <input type="text" class="form-control" name="comp">
        </div>
        <div class="col-md-6">
            <label class="form-label">Project Date</label>
            <input type="date" class="form-control" name="pdate">
        </div>
        <div class="col-6">
            <label class="form-label">URL</label>
            <input type="text" class="form-control" placeholder="http://www.example.com" name="url">
        </div>  
        <div class="col-6">
            <label class="form-label">GitHub</label>
            <input type="text" class="form-control" placeholder="http://www.example.com" name="git">
        </div>
        <div class="col-6">
            <label class="form-label">Project picture (PNG)</label>
            <input class="form-control" type="file" name="picpng"  multiple/>
        </div>
        <div class="col-6">
            <label class="form-label">Project picture (GIF)</label>
            <input class="form-control" type="file" name="picgif"  multiple/>
        </div>
        

        <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>   

    </form>

</div>
