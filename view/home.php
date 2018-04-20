<?php
$ar = fetchAllRecords();
$sum = 0;
for ($i = 0; $i < count($ar); $i++){
$sum=$ar[$i][6]+$sum;
}
?>

<html>
<head>
        <title> Shopstore </title>
</head>

<style>
            
            body{
                background: url(pics/a.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
            }
            
</style>

<h1 class="text-center" style="color:darkblue"><strong> Shopstore </strong></h1> <br><br>
<?php
if (isset($_SESSION['role'])){
if ($_SESSION['role'] == "user"){
echo "<div style='padding-left:1190px;'>
            <a href='index.php?p=cart' class='btn btn-warning'> <span class='glyphicon glyphicon-shopping-cart'></span> &nbsp; Cart <span class='badge'> $sum </span> </a>
</div><br>";
}
}
?>

<?php
if(isset($_GET['status'])){    
changeStatus();
header("location:index.php?p=home");
}

if(isset($_POST['u1'])){
    update();
}

if(isset($_GET['did'])){
    productdelete();
}

$ar = fetchAllRecords();

for ($i = 0; $i < count($ar); $i++) {
echo"
<div class ='col-lg-3'>
    <div style='padding-left:25px;'> <img src='img/".$ar[$i][5]."' width='250' height='250'/> </div>
    <center> <h4 style='color:darkblue' class= 'a'> ".$ar[$i][1]." </h4>
<h3 class= 'a'> <b> ₹ ".$ar[$i][4]."  </b> </h3>";

if (isset($_SESSION['role'])){
if ($_SESSION['role'] == "user"){
echo "<form method='post'>
<div class='col-md-4'>    
<label class='col-sm-2 control-label'>Quantity</label>
<div style='padding-left:15px;'><input type='text' required='required' class='form-control' id='quan' name='quan' value='1' readonly></div></div>
</form>";

if($ar[$i][6] == 0){
    echo "<br><a href='index.php?p=home&uid=".$ar[$i][0]."&status=".$ar[$i][6]."'>"
    . "<button class='btn btn-primary' data-toggle='tooltip' data-placement='top' title = 'Add to Cart'><span class='glyphicon glyphicon-ok'></span> Add to Cart</button></a> &nbsp; &nbsp;";
}
else{
     echo "<br><a href='index.php?p=home&uid=".$ar[$i][0]."&status=".$ar[$i][6]."'>"
    . "<button class='btn btn-danger' data-toggle='tooltip' data-placement='top' title = 'Remove from Cart'><span class='glyphicon glyphicon-remove'></span> Remove from Cart</button></a> &nbsp; &nbsp;";
}
echo "<br><br>";
}

elseif ($_SESSION['role'] == "admin"){
echo"&nbsp; <a class='btn btn-danger btn-circle' href='index.php?p=home&did=".$ar[$i][0]."'>"
. " Delete </a><br>";     
}
}

else{};

echo "<br></div>";
}
?>