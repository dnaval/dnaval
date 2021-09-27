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
        <span>Add Skills</span>
        <a href="./index.php?dan=skills"><button class='btn btn-secondary float-end'>Skills list</button></a>
    </h1>

    <form class="row g-3" action="./actions/addskillAction.php" method="post" enctype= multipart/form-data>
         <div class="col-md-12">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName" name="skill" required="required">
        </div>
       
        <div class="col-12">
            <label for="formFile" class="form-label">Picture</label>
            <input class="form-control" type="file" id="formFile" name="pic">
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo $fx->gen_token();?>" />
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>   

    </form>

</div>