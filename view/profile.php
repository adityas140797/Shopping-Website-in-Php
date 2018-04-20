<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="admin"){
        header("location:index.php?p=home");
    }
}

?>

<div style="padding-left: 15px;">
<div id ="profile"> <h1 class="text-center" style="color:darkgreen"><strong>YOUR PROFILE</strong></h1>
<?php
$br= getUserById();
$ar = scandir("img");

           echo "<center>";
           echo "<img src='img/$br[7]' height='200' width='200' class='img-circle' /> <br>";
          
           echo "<a href='download.php?p=$br[7]'>Download</a>";
           echo "<center>";

?>
</div></div>  
<br> <div style="padding-right: 80px;">  
                
        <div style="padding-left: 98px;"> <h3 class="text-center"  >Name : &nbsp;
                <input type="text" name="name" readonly
                       value="<?php echo $br[1];?>" /> </h3> </div>
        <div style="padding-left: 75px;"> <h3 class="text-center" >Email Id : &nbsp;
                <input type="text" name="emailid" readonly
                       value="<?php echo $br[2];?>" /> </h3> </div>
        <div style="padding-right: 0px;"> <h3 class="text-center" >Mobile Number : &nbsp;
                <input type="text" name="mobilenumber" readonly
                       value="<?php echo $br[4];?>" /> </h3> </div>
        <div style="padding-left: 35px;"> <h3 class="text-center" >Date of birth : &nbsp;
                <input type="text" name="dob" readonly
                       value="<?php echo $br[5];?>" /> </h3> </div>    
        <div style="padding-left: 75px;"> <h3 class="text-center" >Address : &nbsp;
                <input type="text" name="address" readonly
                       value="<?php echo $br[6];?>" /> </h3> </div>
       
<br> <div style="padding-left: 85px;">
<?php echo "<center><a href='index.php?p=edit&eid=".$br[0]."'><button type='button' class='btn btn-success'>Edit</button><a></center>"; ?>
</div> </div>
</div>