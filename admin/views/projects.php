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

$roleid = $_SESSION['role'];


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
            <span>Projects List</span>
            <?php 
                if($roleid != 2) { 
                    echo '<a href="./index.php?dan=addproject"><button class="btn btn-secondary btn-space float-end me-2">Add project</button></a>';
                } 
             ?>
        </h1>

        <hr/>

       <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $resultReq = $dncl->listProjects();
                    if($resultReq) {
                        echo '<tr>';   
                        foreach($resultReq as $key => $val) {    
                            echo '<td>'.$val['project'].'</td>
                            <td style="width: 30%;">'.$val['description'].'</td>
                            <td>'.$val['type'].'</td>
                            <td>'.$val['projectdate'].'</td>';
                            if(!empty($val['url'])) {
                                echo '<td><a href="'.$val['url'].'">Link</a></td>';
                            } else {
                                echo '<td><a href="'.$val['github'].'">Link</a></td>';
                            }
                        echo '<td>
                                  <a href="#exampleModal" class="btn btn-primary me-2" data-bs-toggle="modal" data-id="'.$val['idproject'].'" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                  if($roleid != 2) {
                                    echo '<a type="button" class="btn btn-danger me-2" title="Delete" href="./actions/deleteprojectAction.php?ID='.$val['idproject'].'" onclick="return confirm(\'Are you sure you want to delete this project?\');"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                                  }
                               echo '</td>
                             </tr>';
                        }
                    }
                ?>
            
    
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>

    
    <!--  Modal edit Form  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="row g-3" action="./actions/editprojectAction.php" method="post" enctype= multipart/form-data>

                       <div class="fetched-data"></div>

                       <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
        
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- END Modal edit Form  -->


</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

<!-- Data table JS script -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<!-- Modal fetch data JS script -->
<script type="text/javascript">
   $(document).ready(function(){
    $('#exampleModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : './actions/projectinfo.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});
</script>

<script type="text/javascript">
   function Confirm()
   {
        let conf = confirm('Are you sure you want to delete this project?');
        if (conf)
            return false;
        else
            return true;
   }
</script>