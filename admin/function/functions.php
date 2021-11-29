<?php

function get_total_user($conn){
    $qry = "SELECT * FROM `user_data`";
    $res =$conn->query($qry);
    $count = $res->num_rows;
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}
function get_total_reffral($conn){
    $qry = "SELECT * FROM `user_data` WHERE u_reffral_by != '0'";
    $res =$conn->query($qry);
    $count = $res->num_rows;
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}
function get_total_amount($conn){
    $qry = "SELECT SUM(payment_amount) AS total_amount FROM `form_data`";
    $res =$conn->query($qry);
    $row = $res->fetch_assoc();
    return $row['total_amount'];
}
function task_one_stats($conn){
    $qry = "SELECT SUM(u_task_email) AS task_one_stats FROM `user_data`";
    $res =$conn->query($qry);
    $row = $res->fetch_assoc();
    return $row['task_one_stats'];
}
function task_two_stats($conn){
    $qry = "SELECT SUM(u_task_share) AS task_two_stats FROM `user_data`";
    $res =$conn->query($qry);
    $row = $res->fetch_assoc();
    return $row['task_two_stats'];
}
function task_three_stats($conn){
    $qry = "SELECT SUM(u_task_form) AS task_three_stats FROM `user_data`";
    $res =$conn->query($qry);
    $row = $res->fetch_assoc();
    return $row['task_three_stats'];
}
function task_four_stats($conn){
    $qry = "SELECT SUM(u_task_pay) AS task_four_stats FROM `user_data`";
    $res =$conn->query($qry);
    $row = $res->fetch_assoc();
    return $row['task_four_stats'];
}

function get_all_users($conn){
    $qry = "SELECT * FROM `user_data` order by u_id desc";
    $res = $conn->query($qry);
    if($res->num_rows > 0){
        return $res;
    } else{
        return 'no_user';
    }
}
function get_all_reffral_users($conn,$id){
    $qry = "SELECT * FROM `user_data` WHERE u_reffral_by='$id'";
    $res = $conn->query($qry);
    if($res->num_rows > 0){
        return $res;
    } else{
        return 'no_user';
    }
}
function get_user_task_stats($conn,$id){
    $qry = "SELECT * FROM `user_data` WHERE u_id='$id'";
    $res = $conn->query($qry);
    $row=$res->fetch_assoc();
    $stats = (($row['u_task_email']+$row['u_task_share']+$row['u_task_form']+$row['u_task_pay'])/4)*100;
    return $stats;
}

function get_user_reffrals($conn,$id){
    $qry = "SELECT * FROM `user_data` WHERE u_id='$id'";
    $res = $conn->query($qry);
    $row=$res->fetch_assoc();
    $user_ref_id = $row['u_reffral'];

    $qry = "SELECT * FROM `user_data` WHERE u_reffral_by='$user_ref_id'";
    $res = $conn->query($qry);
    $total_reffral = $res->num_rows;
    return $total_reffral;
}