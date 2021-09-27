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
    $info = $dncl->getTypeInfo($id);
    foreach($info as $val) {
?>
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit project type ID : <?php echo $val['idtype']; ?></h5>
        <input type="hidden" name="tid" value="<?php echo $val['idtype']; ?>">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    
                <div class="col-md-12">
                    <label for="inputName" class="form-label">Type Name</label>
                    <input type="text" class="form-control" id="inputName" name="type" value="<?php echo $val['type']; ?>">
                </div>

                <div class="col-md-12">
                    <label for="inputName" class="form-label">Type Name</label>
                    <input type="text" class="form-control" id="inputName" name="filt" value="<?php echo $val['filter']; ?>">
                </div>
               
                </div>
        </div>
                
<?php

    }
 }
?>