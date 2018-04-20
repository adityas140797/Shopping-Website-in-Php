<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="user"){
        header("location:index.php?p=home");
    }
}
if(isset($_POST['s2'])){
    insert();
            
    $fname = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    (move_uploaded_file($tmp_name, "img/$fname"));
   
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
  
    </head>
    <body>

            <br><br><br>
            <div class="row ">
                <div class="col-lg-offset-2 col-lg-7">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Product Here</h3>
                    </div>
                    <div class="panel-body">
                        <form name="f" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return abc();">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <input type="text" required="required" class="form-control" id="name" name="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
        <input type="text" required="required" class="form-control" id="desc" name="des" placeholder="Description">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Quantity</label>
    <div class="col-sm-10">
        <input type="text" required="required" class="form-control" id="quantity" name="quantity" value="1" readonly>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
    <div class="col-sm-10">
        <input type="text" required="required" class="form-control" id="price" name="price" placeholder="Price">
    </div>
  </div>
     
 <div style="padding-top: 10px; padding-left: 70px;" class="form-group">
            <label for="exampleInputFile">Photo</label>
            <input type="file" name="photo" />
            <p class="help-block">Upload your photo here.</p>
 </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      
    </div>
  </div>

 <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type ="submit" class="btn btn-success" name="s2" value="Submit" /> 
    </div>
  </div>
</form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
                 <div class="col-lg-3"></div>
                </div>
               
    </body>
</html>