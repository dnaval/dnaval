<?php
//FX Class
require '../lib/dnfunctions.php';
$fx = new dnfunctions();

//Get the dbconfig class
include_once '../../config/dbconfigPDO.php';

//Get the model class
include_once '../../models/DAN.php';

//instantiate db and connect
$bdobject = new dbconfigPDO();
$bdinst = $bdobject->connect();

//instantiate model class
$dncl = new DAN($bdinst);



//Get user info for edit form
if($_POST['rowid']) {
    $id = $_POST['rowid']; 
    $info = $dncl->getProject($id);
    foreach($info as $val) {
?>

    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit project ID : <?php echo $val['idproject']; ?></h5>
        <input type="hidden" name="pid" value="<?php echo $val['idproject']; ?>">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    
    <div class="col-md-12">
            <label class="form-label">Project Name</label>
            <input type="text" class="form-control" name="pname" value="<?php echo $val['project']; ?>">
        </div>
        <div class="col-md-12">
            <label class="form-label">Description</label>
            <textarea id="dntextarea" name="desc" class="form-control"><?php echo $val['description']; ?></textarea>
        </div>
        <div class="col-md-12">
            <label class="form-label">Category</label>
            <input type="text" class="form-control" name="catego" value="<?php echo $val['category']; ?>">
        </div>
        <div class="col-md-12">
            <label class="form-label">Project Type</label>
            <select class="form-select" name="typid">
            <option value="">Choose a project type</option>
            <?php
                $resd = $dncl->getFilterType();
                if($resd) {
                    foreach($resd as $keyd => $vald) {
                    
                        if($val['idtype']==$vald['idtype']) {
                            echo '<option value="'.$vald['idtype'].'" selected>'.$vald['type'].'</option>';
                        } else {
                            echo '<option value="'.$vald['idtype'].'">'.$vald['type'].'</option>';
                        }
                    }

                }
            ?>
            </select>
        </div>
        <div class="col-md-12">
            <label class="form-label">Client / Company</label>
            <input type="text" class="form-control" name="comp" value="<?php echo $val['company']; ?>">
        </div>
        <div class="col-md-12">
            <label class="form-label">Project Date</label>
            <input type="date" class="form-control" name="pdate" value="<?php echo $val['projectdate']; ?>">
        </div>
        <div class="col-12">
            <label class="form-label">URL</label>
            <input type="text" class="form-control" value="<?php echo $val['url']; ?>" name="url">
        </div>  
        <div class="col-12">
            <label class="form-label">GitHub</label>
            <input type="text" class="form-control" value="<?php echo $val['github']; ?>" name="git">
        </div>
        <div class="col-12">
            <label class="form-label">Project picture (PNG)</label>
            <input class="form-control" type="file" name="picpng">
            <input type="hidden" name="picg" value="<?php echo $val['picture']; ?>">
        </div>
        <div class="col-12">
            <label class="form-label">Project picture (GIF)</label>
            <input class="form-control" type="file" name="picgif">
            <input type="hidden" name="picf" value="<?php echo $val['gif']; ?>">
        </div>

    </div>
                
<?php

    }
 }
?>
