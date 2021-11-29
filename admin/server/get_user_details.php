<?php
include "../config/config.php";

if(isset($_POST)){
    $id=$_POST['id'];
    $qry="SELECT * FROM `user_data` WHERE u_id='$id'";
    $res = $conn->query($qry);
    $row=$res->fetch_assoc();
    $email= $row['u_email'];
    $reffral = $row['u_reffral'];
    $url="http://rav.ai/";
    $reffral_link=$url."index.php?ref=$reffral";
    $task_email=$row['u_task_email'];
    $task_share=$row['u_task_share'];
    $task_form=$row['u_task_form'];
    $task_pay=$row['u_task_pay'];

    $task_email_stats="";
    $task_share_stats="";
    $task_form_stats="";
    $task_pay_stats="";
    if($task_email == '1'){
        $task_email_stats="completed";
    }else{
        $task_email_stats="uncomplete";
    }
    if($task_share == '1'){
        $task_share_stats="completed";
    }else{
        $task_share_stats="uncomplete";
    }
    if($task_form == '1'){
        $task_form_stats="completed";
    }else{
        $task_form_stats="uncomplete";
    }
    if($task_pay == '1'){
        $task_pay_stats="completed";
    }else{
        $task_pay_stats="uncomplete";
    }
    /*********************************************************/
    $reffral_qry="SELECT * FROM `user_data` WHERE u_reffral_by='$reffral'";
    $reffral_res = $conn->query($reffral_qry);
    $reffral_count = $reffral_res->num_rows;
    /*********************************************************/
    $form_data_qry="SELECT * FROM `form_data` WHERE f_user_email='$email'";
    $form_data_res = $conn->query($form_data_qry);
    if($form_data_res->num_rows > 0){
        $form_data=$form_data_res->fetch_assoc();
        $social_platform=$form_data['f_social_platform'];
        $category=$form_data['f_category'];
        $social_handle=$form_data['f_social_handle'];
        $name=$form_data['fname']." ".$form_data['lname'];
        $payment_method=$form_data['payment_method'];
        $payment_id=$form_data['payment_id'];
        $amount=$form_data['payment_amount'];


    } else{
        $social_platform='none';
        $category='none';
        $social_handle='none';
        $name='none';
    }
    ?>
    <div class="row">
                        <div class="col-lg-6">
                            <h4>User Details:</h4>
                            <!-- <div class="badge badge-success badge-success-alt">(2) Reffrals</div> -->
                            <h6><span>Email:</span> <?php echo $email; ?></h6>
                            <h6><span>Reffral link:</span> <?php echo $reffral_link; ?></h6>
                            <h6><span>Task email:</span> <span class="<?php echo $task_email_stats." "; if($task_email == '1'){echo "badge badge-success badge-success-alt"; }else{echo "badge badge-danger badge-danger-alt"; } ?> "><?php echo $task_email_stats; ?></span> </h6>
                            <h6><span>Task share:</span> <span class="<?php echo $task_share_stats." "; if($task_share == '1'){echo "badge badge-success badge-success-alt"; }else{echo "badge badge-danger badge-danger-alt"; } ?> "><?php echo $task_share_stats; ?></span></h6>
                            <h6><span>Task form fill:</span> <span class="<?php echo $task_form_stats." "; if($task_form == '1'){echo "badge badge-success badge-success-alt"; }else{echo "badge badge-danger badge-danger-alt"; }  ?> "><?php echo $task_form_stats; ?></span></h6>
                            <h6><span>Task pay:</span> <span class="<?php echo $task_pay_stats." "; if($task_pay == '1'){echo "badge badge-success badge-success-alt"; }else{echo "badge badge-danger badge-danger-alt"; } ?> "><?php echo $task_pay_stats; ?></span></h6>
                            <h6><span>Reffral users:</span> <?php echo $reffral_count; ?> <a href="<?php echo $url."admin/reffral_user.php?reff=$reffral"; ?>"><u>see more</u></a></h6>
                        </div>
                        <div class="col-lg-6">
                            <h6><span>Social platform:</span> <span><?php echo $social_platform; ?></span> </h6>
                            <h6><span>Category:</span> <span><?php echo $category; ?></span></h6>
                            <h6><span>Social handle:</span> <span><?php echo $social_handle; ?></span></h6>
                            <h4 class="mt-3">Payment Details:</h4>
                            <?php if($name=='none'){
                                ?><h6>No payment has made yet</h6><?php
                            } else{ ?>
                            <h6><span>Name:</span> <span><?php echo $name; ?></span></h6>
                            <h6><span>Payment method:</span> <?php echo $payment_method; ?></h6>
                            <h6><span>Payment id:</span> <?php echo $payment_id; ?></h6>
                            <h6><span>Amount:</span> $ <?php echo $amount; ?></h6>
                            <?php } ?>
                        </div>
                    </div>
    <?php
}