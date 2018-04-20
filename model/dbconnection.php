<?php
define('user', "root");
define('password', 'AdItYa$h');
define('database', "shop");
define('host', "localhost");

function getConnection(){
    
    $con = new mysqli(host, user, password, database);
    
    mysqli_error($con);
    
    return $con;
}

