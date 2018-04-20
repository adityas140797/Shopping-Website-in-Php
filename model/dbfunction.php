<?php
// i  = integer, d = decimal , s = string ,b = blob
function insert(){
    extract($_POST);
    
    $fname = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    (move_uploaded_file($tmp_name, "img/$fname"));
    
    $con = getConnection() ;
    $stmt = $con->prepare("insert into 
            cart(name , des , quantity , price , photo , status) 
             values (?,?,?,?,?,?)");
  
    $stmt->bind_param("ssiisi", $name , $des , $quantity , $price , $photo, $status);
    $name = $name;
    $des = $des;
    $quantity = $quantity;
    $price = $price;
    $photo = $fname;
    $status = $status;
   
    $stmt->execute() or die(mysqli_error($con));
    
}

function fetchAllRecords(){
       
    $con = getConnection() ;
    $result = $con->query("select * from cart") or
            die(mysqli_error($con));
        $ar =[] ;
        $co=0;
        while($row = $result->fetch_assoc()){
         $ar[$co][] = $row['id'];    
         $ar[$co][] = $row['name'];    
         $ar[$co][] = $row['des'];    
         $ar[$co][] = $row['quantity'];    
         $ar[$co][] = $row['price'];
         $ar[$co][] = $row['photo'];
         $ar[$co][] = $row['status'];
         $co++;
        }
        return $ar ;
}
    
function changeStatus() {
    $status = $_GET['status'];
     if($status == 0 ){
         $status = 1 ;
     }else {
         $status = 0 ;
     }
    $con = getConnection();
    $stmt = $con->prepare("update cart set status = ? where id= ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ii", $stat , $uidd);
    $stat = $status ;
    $uidd = $_GET['uid'];
    
    $stmt->execute();

}

function update() {

    $quantity = $_POST['quan'];
    $con = getConnection();
    $stmt = $con->prepare("update cart set quantity = ? where id= ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ii", $quan , $uidd);
    $quan = $quantity ;
    $uidd = $_GET['uid'];
    
    $stmt->execute();

}

function userinsert(){
    extract($_POST);
    
    $fname = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    (move_uploaded_file($tmp_name, "img/$fname"));
    
    $con = getConnection() ;
    $stmt = $con->prepare("insert into 
            user(name , emailid , password , mobilenumber , dob , address , photo) 
             values (?,?,?,?,?,?,?)");
  
    $stmt->bind_param("sssssss", $na , $em , $pass , $mob , $dob , $add, $photo);
    $na = $name;
    $em = $emailid;
    $pass = md5($password);
    $mob = $mobilenumber;
    $dob = $dob;
    $add = $address;
    $photo = $fname;
    
    $stmt->execute() or die(mysqli_error($con));
    
}

function check_user(){
    extract($_POST);
    $con = getConnection() ;
    $stmt = $con->prepare("select * from user where emailid = ? and password = ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ss",$eam,$pas);
    $eam = $ea;
    $pas = md5($pa);
        $stmt->bind_result($id,$name,$emailid ,$password, $address ,$mobilenumber, $dob , $photo);
    /* execute query */
    $stmt->execute();
   
        $ar =[] ;
        
 
        while($stmt->fetch()){
           
         $ar[] = $id;   
         $ar[] = $name;   
         $ar[] = $emailid;   
        $ar[] = $password;   
         $ar[] = $address;   
         $ar[] = $mobilenumber;   
         $ar[] = $dob;   
         $ar[] = $photo;   
      
        }
        //print_r($ar);
        return $ar ;
    }
    
function paymentinsert(){
    extract($_POST);
    
    $con = getConnection() ;
    $stmt = $con->prepare("insert into 
            payment(product , creditcardtype , totalcost , accountholdername , creditcardnumber , expirydate , cvv ,emailid) 
             values (?,?,?,?,?,?,?,?)");
  
    $stmt->bind_param("ssisisis", $product , $creditcardtype , $totalcost , $accountholdername , $creditcardnumber , $expirydate , $cvv ,$emailid);
    
    $product = $product;
    $creditcardtype = $creditcardtype;
    $totalcost = $totalcost;
    $accountholdername = $accountholdername;
    $creditcardnumber = $creditcardnumber;
    $expirydate = $expirydate;
    $cvv = $cvv;
    $emailid = $emailid;
    
    $stmt->execute() or die(mysqli_error($con));
    
}

function getEmailIdCheck(){
    
    extract($_GET);
    $con = getConnection();
    $stmt = $con->prepare("select emailid from user where emailid = ?") or die(mysqli_error($con));
    $stmt->bind_param("s", $d);
    $d = $d;
    
    $stmt->bind_result($emailid);
    $stmt->execute();
    $stmt->fetch();
    return $emailid;
    
}

function messageinsert(){
    extract($_POST);
    
    $con = getConnection() ;
    $stmt = $con->prepare("insert into 
            message(name ,emailid ,message) 
             values (?,?,?)");
  
    $stmt->bind_param("sss", $name , $emailid , $message);
    $name = $name;
    $emailid = $emailid;
    $message = $message;
    
    $stmt->execute() or die(mysqli_error($con));
    
}

function productdelete(){
    extract($_GET);
    $con = getConnection() ;
    $stmt = $con->prepare("delete from"
            . "  cart where id = ? ");
    $stmt->bind_param("i", $id);
    $id = $did;
       
    $stmt->execute() or die(mysqli_error($con));
}

function delete(){
    extract($_GET);
    $con = getConnection() ;
    $stmt = $con->prepare("delete from"
            . "  user  where id = ? ");
    $stmt->bind_param("i", $id);
    $id = $did;
       
    $stmt->execute() or die(mysqli_error($con));
    
}

function paging($req) {
    $link = isset($_GET['q'])?$_GET['q']:1;
      $s = $link*$req ;
      $f = $s-$req; 
 
    $con = getConnection();
    $stmt = $con->prepare("select * from user limit ?, ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ii", $f1,$s1);
    $f1 = $f ;
    $s1 = $req ;
    $stmt->bind_result($id, $name, $email, $password, $mobile, $dob ,$address , $photo);
   
    $stmt->execute();

    $ar = [];
    $co = 0;
    while ($stmt->fetch()) {

        $ar[$co][] = $id; $ar[$co][] = $name; $ar[$co][] = $email; $ar[$co][] = $password; 
        $ar[$co][] = $mobile; $ar[$co][] = $dob; $ar[$co][] = $address; $ar[$co][] = $photo;
        $co++;
    }
    //print_r($ar);
    return $ar;
}

function pagelink() {

    $con = getConnection();
    $stmt = $con->prepare("select count(*) from user") or
            die(mysqli_error($con));
    $stmt->bind_result($count);
    /* execute query */
    $stmt->execute();
    $stmt->fetch();
    return $count;
}

function messagepaging($req) {
    $link = isset($_GET['q'])?$_GET['q']:1;
      $s = $link*$req ;
      $f = $s-$req; 
 
    $con = getConnection();
    $stmt = $con->prepare("select * from message limit ?, ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ii", $f1,$s1);
    $f1 = $f ;
    $s1 = $req ;
    $stmt->bind_result($id, $name, $emailid, $message);
   
    $stmt->execute();

    $ar = [];
    $co = 0;
    while ($stmt->fetch()) {

        $ar[$co][] = $id; $ar[$co][] = $name; $ar[$co][] = $emailid; $ar[$co][] = $message;
        $co++;
    }
    //print_r($ar);
    return $ar;
}

function messagepagelink() {

    $con = getConnection();
    $stmt = $con->prepare("select count(*) from message") or
            die(mysqli_error($con));
    $stmt->bind_result($count);
    /* execute query */
    $stmt->execute();
    $stmt->fetch();
    return $count;
}

function paymentpaging($req) {
    $link = isset($_GET['q'])?$_GET['q']:1;
      $s = $link*$req ;
      $f = $s-$req; 
 
    $con = getConnection();
    $stmt = $con->prepare("select * from payment limit ?, ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ii", $f1,$s1);
    $f1 = $f ;
    $s1 = $req ;
    $stmt->bind_result($id, $product, $creditcardtype, $totalcost , $accountholdername, $creditcardnumber , $expirydate, $cvv ,$email);
   
    $stmt->execute();

    $ar = [];
    $co = 0;
    while ($stmt->fetch()) {

        $ar[$co][] = $id; $ar[$co][] = $product; $ar[$co][] = $creditcardtype; $ar[$co][] = $totalcost; $ar[$co][] = $accountholdername; $ar[$co][] = $creditcardnumber; $ar[$co][] = $expirydate; $ar[$co][] = $cvv; $ar[$co][] = $email;
        $co++;
    }
    //print_r($ar);
    return $ar;
}

function paymentpagelink() {

    $con = getConnection();
    $stmt = $con->prepare("select count(*) from payment") or
            die(mysqli_error($con));
    $stmt->bind_result($count);
    /* execute query */
    $stmt->execute();
    $stmt->fetch();
    return $count;
}

function messagecount(){
    $con = getConnection();
    $stmt = $con->prepare("select count(*) from message") or
            die(mysqli_error($con));
 $stmt->bind_result($count);
    /* execute query */
    $stmt->execute();
    $stmt->fetch();
    // print_r($count);
    return $count;
    
}

function productpaging($req) {
    $link = isset($_GET['q'])?$_GET['q']:1;
      $s = $link*$req ;
      $f = $s-$req; 
 
    $con = getConnection();
    $stmt = $con->prepare("select * from cart limit ?, ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ii", $f1,$s1);
    $f1 = $f ;
    $s1 = $req ;
    $stmt->bind_result($id, $name, $des, $quantity, $price, $photo, $status);
   
    $stmt->execute();

    $ar = [];
    $co = 0;
    while ($stmt->fetch()) {

        $ar[$co][] = $id; $ar[$co][] = $name; $ar[$co][] = $des; $ar[$co][] = $quantity; 
        $ar[$co][] = $price; $ar[$co][] = $photo; $ar[$co][] = $status;
        $co++;
    }
    //print_r($ar);
    return $ar;
}

function productpagelink() {

    $con = getConnection();
    $stmt = $con->prepare("select count(*) from cart") or
            die(mysqli_error($con));
    $stmt->bind_result($count);
    /* execute query */
    $stmt->execute();
    $stmt->fetch();
    return $count;
}

function resetStatus() {
    $ar = fetchAllRecords();
    for ($i = 0; $i < count($ar); $i++) {
    $id = $ar[$i][0];   
    
    $con = getConnection();
    $stmt = $con->prepare("update cart set status = ? where id= ?") or
            die(mysqli_error($con));
    $stmt->bind_param("ii", $stat , $uidd);
    $stat = 0;
    $uidd = $id;
    
    $stmt->execute();
    }
}

function paymentpagingbyid($req) {
    $link = isset($_GET['q'])?$_GET['q']:1;
      $s = $link*$req ;
      $f = $s-$req; 
 
    $email = $_SESSION['emailid'];
    $con = getConnection();
    $stmt = $con->prepare("select * from payment where emailid = ?") or
            die(mysqli_error($con));
    $stmt->bind_param("s", $email);
    $email = $email ;
    $stmt->bind_result($id, $product, $creditcardtype, $totalcost , $accountholdername, $creditcardnumber , $expirydate, $cvv ,$email);
   
    $stmt->execute();

    $ar = [];
    $co = 0;
    while ($stmt->fetch()) {

        $ar[$co][] = $id; $ar[$co][] = $product; $ar[$co][] = $creditcardtype; $ar[$co][] = $totalcost; $ar[$co][] = $accountholdername; $ar[$co][] = $creditcardnumber; $ar[$co][] = $expirydate; $ar[$co][] = $cvv; $ar[$co][] = $email;
        $co++;
    }
    //print_r($ar);
    return $ar;
}

function getUserById(){
    $id=$_SESSION['id'];
    $con = getConnection() ;
    $stmt = $con->prepare("select * from user where id = ? ") or
            die(mysqli_error($con));
     $stmt->bind_param("i", $id);
    $id = $id;

        $stmt->bind_result($id,$name,$emailid ,$password, $address ,$mobilenumber, $dob , $photo);
    /* execute query */
    $stmt->execute();
   
        $ar =[] ;
        
 
        while($stmt->fetch()){
           
         $ar[] = $id;   
         $ar[] = $name;   
         $ar[] = $emailid;   
        $ar[] =  $password;   
         $ar[] = $address;   
         $ar[] = $mobilenumber;   
         $ar[] = $dob;   
         $ar[] = $photo;   
      
        }
         return $ar ;
}

function getRecordById(){
    extract($_GET);
    $con = getConnection() ;
    $result = $con->query("select * from user where id = $eid") or
            die(mysqli_error($con));
        $ar =[] ;
     
        while($row = $result->fetch_assoc()){
         $ar[] = $row['id'];    
         $ar[] = $row['name'];    
         $ar[] = $row['emailid'];    
         $ar[] = $row['password'];    
         $ar[] = $row['mobilenumber'];    
         $ar[] = $row['dob'];
         $ar[] = $row['address'];
         $ar[] = $row['photo'];
        }
         return $ar ;
 }
 
 function getProductById(){
    extract($_GET);
    $con = getConnection() ;
    $result = $con->query("select * from cart where id = $eid") or
            die(mysqli_error($con));
        $ar =[] ;
     
        while($row = $result->fetch_assoc()){
         $ar[] = $row['id'];    
         $ar[] = $row['name'];    
         $ar[] = $row['des'];    
         $ar[] = $row['quantity'];    
         $ar[] = $row['price'];    
         $ar[] = $row['photo'];
        }
         return $ar ;
 }
 
function updateuser(){
    
    extract($_POST);
    $con = getConnection() ;
    $stmt = $con->prepare("UPDATE user SET name = ?,  emailid = ?, mobilenumber = ?, dob = ?, address = ? 
          where id = ?") ;
$stmt->bind_param("sssssi", $name , $emailid , $mobilenumber , $dob , $address , $id);
$name = $name ;
$emailid = $emailid;
$mobilenumber = $mobilenumber;
$dob = $dob;
$address = $address;
$id = $id;
$stmt->execute(); 
$stmt->close();
    
}

function inboxinsert(){
    extract($_POST);
    
    $con = getConnection() ;
    $stmt = $con->prepare("insert into 
            inbox(id, emailid, message) 
             values (?,?,?)");
  
    $stmt->bind_param("iss", $id, $emailid , $message);
    $id = $id;
    $emailid = $emailid;
    $message = $message;
    
    $stmt->execute() or die(mysqli_error($con));
    
}

function inboxpaging($req) {
    $link = isset($_GET['q'])?$_GET['q']:1;
      $s = $link*$req ;
      $f = $s-$req; 
 
     
    $email = $_SESSION['emailid'];
    $con = getConnection();
    $stmt = $con->prepare("select * from inbox where emailid = ?") or
            die(mysqli_error($con));
    $stmt->bind_param("s", $f1);
    $f1 = $email;
    $stmt->bind_result($id, $email , $message);
   
    $stmt->execute();

    $ar = [];
    $co = 0;
    while ($stmt->fetch()) {

        $ar[$co][] = $id; $ar[$co][] = $message;
        $co++;
    }
    //print_r($ar);
    return $ar;
}

function inboxlink() {

    $con = getConnection();
    $stmt = $con->prepare("select count(*) from inbox") or
            die(mysqli_error($con));
    $stmt->bind_result($count);
    /* execute query */
    $stmt->execute();
    $stmt->fetch();
    return $count;
}

function edit(){
    
    extract($_POST);
    $con = getConnection() ;
    $stmt = $con->prepare("UPDATE cart SET name = ?,  des = ?, quantity = ?, price = ?, photo = ? 
          where id = ?") ;
$stmt->bind_param("ssiisi", $name , $des , $quantity , $price , $photo , $id);
$name = $name ;
$des = $des;
$quantity = $quantity;
$price = $price;
$photo = $photo;
$id = $id;
$stmt->execute(); 
$stmt->close();
    
}