<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="user"){
        header("location:index.php?p=home");
    }
}
?>

<html>
    
<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>    
    
</html>

<?php

$ar = productpaging(4);
 
 echo "<h2> <center> <font color = 'darkblue'> <b> Modify Products  </b> </font> </center> </h2> <br>";
 echo "<table align='center' class='table table-bordered' border='1'>";
    echo " <tr class='success'><th><center>Id</center></th><th><center>Name</center></th><th><center>Description</center></th><th><center>Quantity</center></th>"
    . "<th><center>Price</center></th><th><center>Photo</center></th><th><center>Status</center></th><th><center>Operation</center></th></center></tr> ";
for($i=0 ; $i<count($ar) ; $i++){
   
    echo "<tr class='warning' align='center'>";
    echo "<td>".$ar[$i][0]."</td>";
    echo "<td>".$ar[$i][1]."</td>";
    echo "<td>".$ar[$i][2]."</td>";
    echo "<td>".$ar[$i][3]."</td>";
    echo "<td>".$ar[$i][4]."</td>";
    echo "<td>".$ar[$i][5]."</td>";
    echo "<td>".$ar[$i][6]."</td>";
    echo "<td><center><a href='index.php?p=editproducts&eid=".$ar[$i][0]."'><button type='button' class='btn btn-success'><span class='glyphicon glyphicon-pencil'></span></button><a></center></td>";
    
    
}

echo "</table>";


$count = productpagelink();
echo "<br>";
echo "<table align='center' border='1'>";
echo "<tr>";
$req = 4 ;
$total = $count;
$link = ceil($total / $req);
for ($i = 1; $i <= $link; $i++) {
    echo "<td> <a href='index.php?p=modifyproduct&q=$i'>&nbsp; &nbsp; $i &nbsp; &nbsp;  </a></td>";
}

echo  "</tr>";
echo "</table>";