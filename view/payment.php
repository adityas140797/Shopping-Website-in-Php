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
if(isset($_POST['p1'])){
paymentinsert();
header("location:index.php?p=paymentsuccessful");    
}

$ar = fetchAllRecords();
$total = 0;
for ($i = 0; $i < count($ar); $i++){
if($ar[$i][6] == 1){
$total = $total + $ar[$i][4];
}
}
?>

<html>
<center>

<h1> <b> <font color="darkblue">Payment</font> </b> </h1>

<img src="pics/download (1).jpe" width="150px;" height="120px;"/> <br><br>

</center>

<div style="padding-right:50px;">

<form class="form-horizontal" method="post">

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Product Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="product" id="product" required="required" readonly value=
         "<?php 
          for ($i = 0; $i < count($ar); $i++){
          if($ar[$i][6] == 1)
          {echo $ar[$i][1];
          echo "&nbsp;";
          }
          }
          ?>"
          />
    </div>
</div>
    
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Email Id</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="emailid" id="emailid" required="required" readonly value=<?php echo $_SESSION['emailid']; ?>>
    </div>
</div>    

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Credit Card Type</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="creditcardtype" id="creditcardtype" required="required" placeholder="Credit Card Type">
</div>
</div>
    
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Total Cost</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="totalcost" id="totalcost" required="required" readonly value=<?php echo $total; ?>>
    </div>
</div>

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Account holder's Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="accountholdername" id="accountholdername" required="required" placeholder="Account holder's Name">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Credit Card Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="creditcardnumber" id="creditcardnumber" required="required" placeholder="Credit Card Number">
    </div>
  </div>
 
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Expiry Date</label>
    <div class="col-sm-10">
    <input type="date" class="form-control" name="expirydate" id="expirydate" required="required" placeholder="Expiry Date">
  </div>
  </div>
  
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">CVV</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="cvv" id="cvv" required="required" placeholder="CVV">
    </div>
  </div>
<center> <input type ="submit" class="btn btn-primary" name="p1" value="Submit" /> </center>
</form>
</div>

&nbsp;
<marquee><h4> <font color="blue"> Note: Payment can be done only through Credit Card.</h4></marquee>
</html>