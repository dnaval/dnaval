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
    $info = $dncl->getSkillInfo($id);
    foreach($info as $val) {
?>
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit skill ID : <?php echo $val['idskills']; ?></h5>
        <input type="hidden" name="sid" value="<?php echo $val['idskills']; ?>">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    
                <div class="col-md-12">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inputName" name="skill" value="<?php echo $val['skills']; ?>">
                </div>

                <div class="col-12">
                    <label for="formFile" class="form-label">Picture</label>
                    <input class="form-control" type="file" id="formFile" name="pic">
                    <input type="hidden" name="picture" value="<?php echo $val['picture']; ?>">
                </div>
               
                </div>
        </div>
                
<?php

    }
 }
?>