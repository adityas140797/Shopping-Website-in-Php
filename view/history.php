<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="admin"){
        header("location:index.php?p=home");
    }
}

?>

<?php
 $ar = paymentpagingbyid(100);
 echo "<center> <h2> <font color = 'darkblue'> <b> History  </b> </font> </center> <br>";
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

?>