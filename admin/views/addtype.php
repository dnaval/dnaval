<?php
//FX Class
require './lib/dnfunctions.php';
$fx = new dnfunctions();

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
        <span>Add project type</span>
        <a href="./index.php?dan=projecttype"><button class='btn btn-secondary float-end'>Project Type</button></a>
    </h1>

    <form class="row g-3" action="./actions/addtypeAction.php" method="post" enctype= multipart/form-data>
         <div class="col-md-12">
            <label for="inputName" class="form-label">Type Name</label>
            <input type="text" class="form-control" id="inputName" name="type" required="required">
        </div>
       
        <div class="col-md-12">
            <label for="inputName" class="form-label">Filter (format: <i>filter-typename</i>)</label>
            <input type="text" class="form-control" id="inputName" name="filt" required="required">
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>   

    </form>

</div>