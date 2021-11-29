<?php
define('HOST','localhost');
define('USER','ravakila_wp854');
define('PASSWORD','plprX@4!45).S5');
define('DATABASE','ravakila_waitlist');


$conn = new mysqli(HOST,USER,PASSWORD,DATABASE);
if($conn->connect_errno > 0){
    die('Error in database connection: '.$conn->connect_errno);
}
?>
