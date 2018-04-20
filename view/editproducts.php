<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="user"){
        header("location:index.php?p=home");
    }
}
if(isset($_POST['e1'])){
    edit();
    header("location:index.php?p=modifyproduct");
}
$ar = getProductById();
?>

<div style="padding-left: 15px;">
<div id ="profile"> <h1 class="text-center" style="color:darkgreen"><strong> Product Details </strong></h1>

</div></div>  
<br> 

<form method="post">
<div style="padding-right: 120px;">  
        
        <input type="hidden" name="id" value="<?php echo $ar[0] ?>" />
        <div style="padding-left: 98px;"> <h3 class="text-center"  >Name : &nbsp;
                <input type="text" name="name"
                       value="<?php echo $ar[1];?>" /> </h3> </div>
        <div style="padding-left: 45px;"> <h3 class="text-center" >Description : &nbsp;
                <input type="text" name="des"
                       value="<?php echo $ar[2];?>" /> </h3> </div>
        <div style="padding-left: 75px;"> <h3 class="text-center" >Quantity : &nbsp;
                <input type="text" name="quantity"
                       value="<?php echo $ar[3];?>" /> </h3> </div>
        <div style="padding-left: 110px;"> <h3 class="text-center" >Price : &nbsp;
                <input type="text" name="price"
                       value="<?php echo $ar[4];?>" /> </h3> </div>    
        <div style="padding-left: 105px;"> <h3 class="text-center" >Photo : &nbsp;
                <input type="text" name="photo"
                       value="<?php echo $ar[5];?>" /> </h3> </div>

<br>
<div style="padding-left: 35px;"> <center> <button type="submit"  class="btn btn-primary" name="e1" value="update" >Update</button> </center> </div>
</div>
</form>