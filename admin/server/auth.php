<?php
session_start();
if(isset($_GET['logout'])){
    session_destroy();
    header('location: ../login.php');
}
if(isset($_POST)){
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    if($username == 'admin' && $pass == 'admin123'){
        echo 'success';
        $_SESSION['user_login']='loggedIn';
    }else{
        echo 'error';
        session_destroy();
    }
}