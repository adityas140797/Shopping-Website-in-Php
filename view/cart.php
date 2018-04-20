<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="admin"){
        header("location:index.php?p=home");
    }
}

?>

<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <meta charset="UTF-8">    
        <title> Shopstore </title>
</head>

<style>
            
            body{
                background: url(pics/a.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
            }
            
    .btn-circle {
        font-weight: bold;
        font-size: 12px;
        padding: 6px 15px;
        border-radius: 20px;
    }
    
    .a {
        padding-left: 26%; 
    }
    
    .b {
        padding-top: 1%; 
    }   

</style>

<?php
$ar = fetchAllRecords();

if(isset($_GET['status'])){
changeStatus();
header("location:index.php?p=cart");
}
echo "<h1 class='text-center' style='color:darkblue'><strong> Cart </strong></h1> <br><br>";

$sum = 0;
for ($i = 0; $i < count($ar); $i++){
$sum=$ar[$i][6]+$sum;
}

if($sum > 0){
for ($i = 0; $i < count($ar); $i++) {
if($ar[$i][6] == 1){
echo" <br>
<div class='container'>
    <ul class='media-list'>
     <li class='media'>
      <div class='media-body'>
        <div class='well well-lg'>
            <div class = 'col-lg-3'> <img src='img/".$ar[$i][5]."' width='250' height='250'/> </div>
            


<h2 style='color:darkblue' class= 'a'> ".$ar[$i][1]." </h2> 

<h3 style='color:yellowgreen' class= 'a'> <i> ".$ar[$i][2]." </i> </h3>

<div class = 'b'>

<h4 style='color:brown' class= 'a'> <b> Quantity : ".$ar[$i][3]." </b> </h4>

<h3 class= 'a'> <b> Price : ₹ ".$ar[$i][4]."  </b> </h3>

<div class = 'b'>
<div class = 'a'>
<a class='btn btn-danger btn-circle text-uppercase' href='index.php?p=cart&uid=".$ar[$i][0]."&status=".$ar[$i][6]."'>"
. "<span class='glyphicon glyphicon-remove'></span> REMOVE  </a> </div> </div> </div></div></div></div>";
}
else{}
}
}

else{
echo "<center>
    <img src='pics/emptycart.png' width='400px;' height='300px;'/> <br>

<h1 class='text-center' style='color:darkblue'><strong> Your Cart is Empty </strong></h1> <br>
</center>";    
}

?>

<?php
$total = 0;
for ($i = 0; $i < count($ar); $i++){
if($ar[$i][6] == 1)
$total = $total + $ar[$i][4];
}
echo "<div style='padding-left:550px;'><center><h2 style='color:brown' class= 'a' align='center'>Total Cart Price : ₹".$total." </h2></center></div><br>";

echo "<center><a href='index.php?p=payment' class='btn btn-success'>Buy Now</a></center><br>";
?>