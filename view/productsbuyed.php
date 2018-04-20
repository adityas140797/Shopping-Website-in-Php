<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="user"){
        header("location:index.php?p=home");
    }
}
$a=  messagecount();
?>

<html>

<body>

<center>
<h2> <font color="green"> Welcome Admin </font> </h2>
<p> Chooose what you want to do. </p>

<a href='index.php?p=addproduct'>Add a product</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href='index.php?p=home'>Delete a product</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href='index.php?p=modifyproduct'>Modify a product</a>
<br><br><br><br>

</center>  
</div>
</form>

</body>
</html>

<ul class="nav nav-pills" role="tablist">
  <li role="presentation" ><a href="index.php?p=adminhome">Records</a></li>
  <li role="presentation"><a href="index.php?p=adminmessages"> Inbox <span class="badge"><?php echo $a; ?></span></a></li>
  <li role="presentation"><a href="index.php?p=productsbuyed"> Products Buyed </a></li>
</ul>
</html>

<?php
 $ar = paymentpaging(4);
 echo "<center> <h2> <font color = 'darkblue'> <b> Products Buyed  </b> </font> </center> <br>";
 echo "<table align='center' class='table table-bordered' border='1'>";
    echo " <tr class='success'><th><center>Id</center></th><th><center>Product Name</center></th><th><center>Credit Card Type</center></th><th><center>Total Cost</center></th><th><center>Account Holder's Name</center></th><th><center>Credit Card Number</center></th><th><center>Expiry Date</center></th><th><center>Cvv</center></th></tr> ";
for($i=0 ; $i<count($ar) ; $i++){
   
    echo "<tr class='warning' align='center'>";
    echo "<td>".$ar[$i][0]."</td>";
    echo "<td>".$ar[$i][1]."</td>";
    echo "<td>".$ar[$i][2]."</td>";
    echo "<td>".$ar[$i][3]."</td>";
    echo "<td>".$ar[$i][4]."</td>";
    echo "<td>".$ar[$i][5]."</td>";
    echo "<td>".$ar[$i][6]."</td>";
    echo "<td>".$ar[$i][7]."</td>";
}

echo "</table>";


$count = paymentpagelink();
echo "<br>";
echo "<table align='center' border='1'>";
echo "<tr>";
$req = 4 ;
$total = $count;
$link = ceil($total / $req);
for ($i = 1; $i <= $link; $i++) {
    echo "<td> <a href='index.php?p=productsbuyed&q=$i'>&nbsp; &nbsp;  $i &nbsp; &nbsp;  </a></td>";
}

echo  "</tr>";
echo "</table>";

?>