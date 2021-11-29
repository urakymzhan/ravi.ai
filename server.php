<?php
session_start();
include 'config.php';
include './function/function.php';


define('HOST','localhost');
define('USER','ravakila_wp854');
define('PASSWORD','plprX@4!45).S5');
define('DATABASE','ravakila_waitlist');

// DB connection
$conn = new mysqli(HOST,USER,PASSWORD,DATABASE);
if($conn->connect_errno > 0){
    die('Error in database connection: '.$conn->connect_errno);
}

if(isset($_POST) || isset($_GET)) { 
    
    if(isset($_GET['error_code'])){
        header('location: index.php');
    }

    // Login settings start
    if(isset($_POST['email']) || isset($_GET['code']) ){
        $email="";
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_SESSION['reffral_id'])){
            $reffral_id=$_SESSION['reffral_id'];
        } else{
            $reffral_id="0";
        }

        /** Login With Google */
        if(isset($_GET['code']) || isset($_GET['scope'])){
            
            $google_token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
            if(!isset($google_token['error'])){
                $google_client->setAccessToken($google_token['access_token']);
                $google_service = new Google_Service_Oauth2($google_client);
                $data = $google_service->userinfo->get();
                if(!empty($data['email'])){
                    $email = $data['email'];
                }
            }
        }

        /** Login With Facebook */
        if( isset($_GET['state'])){
            $fb_token=$fb_helper->getAccessToken();
            $fb->setDefaultAccessToken($fb_token);

            $fb_response = $fb->get('/me?fields=name,email',$fb_token);
            $fb_user = $fb_response->getGraphUser();
            // $fb_userId=$fb_user['id'];
            $email=$fb_user['email'];
        }
        
        /** Login With Facebook */
        $qry="SELECT * FROM user_data WHERE u_email='$email'";
        $res = $conn->query($qry);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            $_SESSION['email'] = $email;
            $_SESSION['rank'] = $row['u_rank'];
            header('location: index1.php');
        } else{
            // Get initial point of listing            
            $row=get_initials($conn);
            $rank=$row['init_email'];
            $token = generate_token();
            function check_token($token,$conn){
                $qry="SELECT * FROM `user_data` WHERE `u_reffral` = '$token'";
                $res = $conn->query($qry);
                if($res->num_rows > 0){
                    check_token($token,$conn);
                }else{
                    return $token;
                }
            }
            $token = check_token($token,$conn);

            $qry="INSERT INTO `user_data`(`u_rank`,`u_email`,`u_reffral`,`u_reffral_by`,`u_task_email`) VALUES ('$rank','$email','$token','$reffral_id','1')";
            $res = $conn->query($qry);
            if($res === TRUE){
                $init_email = $row['init_email'] + 1;
                $init_share = $row['init_share'];
                $init_form = $row['init_form'];
                $init_pay = $row['init_pay'];

                // Update initial points
                $qry="UPDATE `list_init` SET `init_email`='$init_email',`init_share`='$init_share',`init_form`='$init_form',`init_pay`='$init_pay' WHERE init_id=1";
                $res = $conn->query($qry);
                header('location: index1.php');
                if($res === TRUE){
                    $_SESSION['email'] = $email;
                    $_SESSION['rank'] = $rank;

                    header('location: index1.php');
                }
                else{

                }
            }

        }
    }
    // Login settings end

    // Handle Share in index1.php
    if(isset($_POST['action'])){
        // share
        if($_POST['action'] == 'share'){
            $_SESSION['rank'] = $_POST['rank'];
            $rank = $_SESSION['rank'];
            
            $qry = "SELECT * FROM user_data WHERE u_rank='$rank'";
            $res=$conn->query($qry);
            $row = $res->fetch_assoc();
            $id = $row['u_id'];

            
            // Get initial point of listing            
            $row=get_initials($conn);
            $init_email = $row['init_email'];
            $init_share = $row['init_share'];
            $init_form = $row['init_form'];
            $init_pay = $row['init_pay'];

            $check_prev = "SELECT * FROM user_data WHERE u_task_email=1 AND u_task_share=0 AND u_task_form=0 AND u_task_pay=0 AND u_rank=$init_share";
            $check_prev_res = $conn->query($check_prev);
            if($check_prev_res->num_rows > 0){
                sort_user_inc($conn,1,0,0,0);
                $init_email = $init_email + 1;
                $init_share = $init_share + 1;
            }else{
                sort_user_dec($conn,1,0,0,0, $rank);
                $init_email = $init_email - 1;
                $init_share = $init_share + 1;
            }
            
            $qry="UPDATE `list_init` SET `init_email`='$init_email',`init_share`='$init_share',`init_form`='$init_form',`init_pay`='$init_pay' WHERE init_id=1";
            $res = $conn->query($qry);
            if($res === TRUE){ 
                $init_share=$init_share-1;
                $qry="UPDATE `user_data` SET `u_rank`='$init_share',`u_task_share`=1 WHERE u_id='$id'";
                $res = $conn->query($qry);
                if($res === TRUE){
                    $_SESSION['rank']=$init_share;
                    echo 'success';
                }else{
                    echo 'error1';
                }
            }else{
                echo 'error2';


            }
        }
        // form
        if($_POST['action'] == 'form'){
            $_SESSION['rank']=$_POST['rank'];
            $rank=$_SESSION['rank'];

            $qry = "SELECT * FROM user_data WHERE u_rank='$rank'";
            $res=$conn->query($qry);
            $row = $res->fetch_assoc();
            $id = $row['u_id'];
            $user_email = $row['u_email'];

        
            // Get initial point of listing            
            $row=get_initials($conn);
            $init_email = $row['init_email'];
            $init_share = $row['init_share'];
            $init_form = $row['init_form'];
            $init_pay = $row['init_pay'];

            $check_prev = "SELECT * FROM user_data WHERE u_task_email=1 AND u_task_share=1 AND u_task_form=0 AND u_task_pay=0 AND u_rank=$init_form";
            $check_prev_res = $conn->query($check_prev);
            if($check_prev_res->num_rows > 0){
                sort_user_inc($conn,1,1,0,0);
                $init_share = $init_share + 1;
                $init_form = $init_form + 1;
            }else{
                sort_user_dec($conn,1,1,0,0,$rank);
                $init_share = $init_share - 1;
                $init_form = $init_form + 1;
            }


            $qry="UPDATE `list_init` SET `init_email`='$init_email',`init_share`='$init_share',`init_form`='$init_form',`init_pay`='$init_pay' WHERE init_id=1";
            $res = $conn->query($qry);
            if($res === TRUE){
                $init_form=$init_form-1;
                $qry="UPDATE `user_data` SET `u_rank`='$init_form',`u_task_form`=1 WHERE u_id='$id'";
                $res = $conn->query($qry);
                if($res === TRUE){
                    $a1=$_POST['a1'];
                    $a2=$_POST['a2'];
                    $a3=$_POST['a3'];
                    $qry="INSERT INTO `form_data`(`f_user_email`,`f_social_platform`, `f_category`, `f_social_handle`) VALUES ('$user_email','$a1','$a2','$a3')";
                    $res=$conn->query($qry);
                    if($res === TRUE){
                        $_SESSION['rank']=$init_form;
                        echo 'success';
                    }else{
                        echo 'error';
                    }
                }else{
                    echo 'error1';
                }
            }else{
                echo 'error2';
            }
        }
        // pay
        if($_POST['action'] == 'pay'){
            $_SESSION['rank']=$_POST['rank'];
            $rank = $_SESSION['rank'];

            $qry = "SELECT * FROM user_data WHERE u_rank='$rank'";
            $res=$conn->query($qry);
            $row = $res->fetch_assoc();
            $id = $row['u_id'];
            $user_email = $row['u_email'];

            

            // Get initial point of listing            
            $row=get_initials($conn);
            $init_email = $row['init_email'];
            $init_share = $row['init_share'];
            $init_form = $row['init_form'];
            $init_pay = $row['init_pay'];


            $check_prev = "SELECT * FROM user_data WHERE u_task_email=1 AND u_task_share=1 AND u_task_form=1 AND u_task_pay=0 AND u_rank=$init_pay";
            $check_prev_res = $conn->query($check_prev);

            if($check_prev_res->num_rows > 0){
                sort_user_inc($conn,1,1,1,0);
                $init_form = $init_form + 1;
                $init_pay = $init_pay + 1;
            }else{
                sort_user_dec($conn,1,1,1,0,$rank);
                $init_form = $init_form - 1;
                $init_pay = $init_pay + 1;
            }

            // update list_init
            $qry="UPDATE `list_init` SET `init_email`='$init_email',`init_share`='$init_share',`init_form`='$init_form',`init_pay`='$init_pay' WHERE init_id=1";
            $res = $conn->query($qry);
            if($res === TRUE){
                $init_pay=$init_pay-1;
                $qry="UPDATE `user_data` SET `u_rank`='$init_pay',`u_task_pay`='1' WHERE u_id='$id'";
                $res = $conn->query($qry);
                if($res === TRUE){
                    $payment_method=$_POST['payment_method'];
                    $fname=$_POST['fname'];
                    $lname=$_POST['lname'];
                    $payment_status=$_POST['payment_status'];
                    $payment_id=$_POST['payment_id'];
                    $payment_amount=$_POST['payment_amount'] / 100;
                  
                    $qry="UPDATE `form_data` SET `payment_method`='$payment_method', `payment_status`='$payment_status', `fname`='$fname', `lname`='$lname', `payment_id`='$payment_id', `payment_amount`='$payment_amount' WHERE f_user_email='$user_email'";
                    
                    $res=$conn->query($qry);
                    if($res === TRUE){
                        $_SESSION['rank'] = $init_pay;
                        echo 'success';
                    }else{
                        echo 'error';
                    }
                }else{
                    echo 'error1';
                }
            }else{
                echo 'error2';
            }
        }
    }
}

function get_initials($conn){
    $qry="SELECT * FROM list_init WHERE init_id=1";
    $res= $conn->query($qry);
    $row=$res->fetch_assoc();
    return $row;
}

function sort_user_dec($conn,$e,$s,$f,$p,$current_rank){
    $qry = "SELECT * FROM `user_data` WHERE u_task_email=$e AND u_task_share=$s AND u_task_form=$f AND u_task_pay=$p";
    $res = $conn->query($qry);
    if($res->num_rows>0){
        while($row = $res->fetch_assoc()){
            $id = $row['u_id'];
            $rank = $row['u_rank'];
            if($rank > $current_rank){

                $rank = $rank-1;

                $update_user = "UPDATE `user_data` SET `u_rank`='$rank' WHERE u_id=$id";
                $update_res = $conn->query($update_user);
                if($update_res != true){
                    break;
                    return false;
                }
            }           
        }
        return true;
    }else{
        return false;
    }
}
// 3504 => 2130

function sort_user_inc($conn,$e,$s,$f,$p){
    $qry = "SELECT * FROM `user_data` WHERE u_task_email=$e AND u_task_share=$s AND u_task_form=$f AND u_task_pay=$p";
    $res = $conn->query($qry);
    if($res->num_rows>0){
        while($row = $res->fetch_assoc()){
            $id = $row['u_id'];
            $rank = $row['u_rank']+1;
            $update_user = "UPDATE `user_data` SET `u_rank`='$rank' WHERE u_id=$id";
            $update_res = $conn->query($update_user);
            if($update_res != true){
                break;
                return false;
            }
        }
        return true;
    }else{
        return false;
    }
}

?>