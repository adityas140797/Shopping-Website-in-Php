<?php
if(!isset($_SESSION['role'])){
       header("location:index.php?p=home");}
else {
    if ($_SESSION['role']=="admin"){
        header("location:index.php?p=home");
    }
}

?>

<center>

<h2> <font color="darkblue"> Payment has been successful. </font> </h2>
<h4> Thank you for shopping at Shopstore.Hope to see you again.Have a great day. </h4>

<a href="index.php?p=home" class="btn btn-success">Back to Home</a>

</center>