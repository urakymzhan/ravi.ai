<?php
require "server.php";
$email = "";
$rank = "0";
$status=0;

/**
 * Get last user email
 */

$last_user_query = "SELECT * FROM user_data ORDER BY u_id DESC LIMIT 2";
$last_user_res = $conn->query($last_user_query);

// while($last_user_row = $last_user_res->fetch_assoc()){
//     $last_user_email = $last_user_row['u_email']; 
// }

if(isset($_SESSION['email'])){
    $rank = $_SESSION['rank'];
    $email = $_SESSION['email'];

    // remove
    print_r("rank");
    print_r($rank);
    print_r($email);

    // $new_user = $rank;
    $qry = "SELECT * FROM user_data WHERE u_email='$email'";
    $res=$conn->query($qry);
    $row = $res->fetch_assoc();
    // $email= $row['u_email'];
    $status = $row['u_task_pay'];
    // $qry2 = "SELECT * FROM user_data WHERE u_rank='$rank'";
    // $res2=$conn->query($qry2);
    // $row2 = $res2->fetch_assoc();
    // $email2=$row2['u_email'];
}
$qry2="SELECT * FROM list_init WHERE init_id=1";
$res2=$conn->query($qry2);
$row2=$res2->fetch_assoc();

   // remove
   print_r("row2");
   print_r($row2);

// Current user
$last_user_email = $email; 

    // remove
    print_r("last_user_email");
    print_r($last_user_email);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="Web Design">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Manik MT">
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->

    <link rel="apple-touch-icon" sizes="180x180" href="img/logo.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo.png"> 
    <!-- Font awsome style -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="webfont/stylesheet.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive midea css -->
    <link rel="stylesheet" href="css/media.css">
    <title>Rav Ai</title>


</head>

<body>
    <!--         <script src="https://apps.elfsight.com/p/platform.js" defer></script>
        <div class="elfsight-app-c4dfb028-e866-467e-bda2-f731a5474188"></div> -->
    <!-- .banner start -->
    <div class="banner">
        <!-- container start -->
        <div class="container">
            <div class="banner_box payment_page">
                <img src="img/logo.png" alt="img" class="img-fluid">
                <h1><a href="#">rav.ai</a> professional short form videos stop wasting time editing</h1>
                <form>
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <button type="submit">Get Early Access</button>
                </form>
            </div>
            <!-- Thank you start -->
            <div class="thank_you payment_page text-center">
                <div class="thank_top">
                    <h2 class="mb-2">Congrats!</h2>
                    <!-- TODO: incorrect number shows -->
                    <p>You’ve jumped 
                        <b>
                            <?php if($status == 0){ 
                                echo number_format($row2['init_share'] - $rank);
                            }else { 
                                echo number_format($row2['init_form'] - $rank);} 
                            ?>
                        </b> 
                        spots
                    </p>
                </div>
                <div class="box">
                    <h3>
                        <strong>
                            <?php if($status == 0){ 
                                    echo number_format($rank-1);
                                }else {
                                    echo number_format($rank-1);} 
                            ?>
                        </strong> 
                        People ahead of you
                    </h3>
                    <h4>This reservation is held for

                    <a href="mailto: <?php if($last_user_email != ""){ echo $last_user_email; }else{ echo "thebest@gmail.com";} ?>"><?php if($last_user_email != ""){ echo $last_user_email; }else{ echo "thebest@gmail.com";} ?></a>.
                        Is this <a>not you?</a>
                    </h4>
                </div>
                <div class="thank_access">
                    <h4 class="mb-3">Exclusive access</h4>
                    <p class="text-left mb-2">Fully refundable. Your card will not be charged until your trial is
                        confirmed.</p>
                    <p class="text-left"><span class="payment-amount">$100</span> 4 30-second videos or 2 10-minute Videos</p>
                    <div class="method">
                        <h4>Select Payment Method</h4>
                        <div class="method_box">
                            <label>
                                <input type="radio" name="payment_method" value="apple_pay" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                            <img src="img/Apple_Pay.png" alt="img" class="img-fluid">
                        </div>
                        <div class="method_box">
                            <label>
                                <input type="radio" name="payment_method" value="paypal">
                                <span class="checkmark payment_method_paypal"></span>
                            </label>
                            <img src="img/paypal.png" alt="img" class="img-fluid">
                        </div>
                        <div class="method_box">
                            <label>
                                <input type="radio" name="payment_method" value="visa" >
                                <span class="checkmark payment_method_visa"></span>
                            </label>
                            <img src="img/visa.png" alt="img" class="img-fluid">
                        </div>
                        
                        <input type="hidden" name="" id="user_rank" data-rank="<?php echo $rank;?>">
                        <form id='payment_form'>
                            <!-- <form  id='order_process_form' > -->

                            <div class="card_info_form text-left mt-4 ml-md-5" style='display:none;'>
                                <div class="form-group">
                                    <label>First Name
                                        <input class="form-control fname" type="text" name="fname" placeholder="Jon"><i
                                            class="fas fa-pen"></i></label>
                                    <label>Last Name
                                        <input class="form-control lname" type="text" name="lname" placeholder="Doe"><i
                                            class="fas fa-pen"></i></label>
                                </div>
                                <div class="form-group">
                                    <label style="width: 87%;">Card Number
                                        <div class="form-control lcnum" id="card-number"></div>
                                        <i class="fas fa-pen"></i>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label style="width:45%">Expiry
                                        <div class="form-control lcexp" id="card-expiry"></div>
                                        <i class="fas fa-pen"></i>
                                    </label>
                                    <label style="width:45%">CVV
                                        <div class="form-control lccvv" id="card-cvc"></div>
                                        <i class="fas fa-pen"></i>
                                    </label>
                                </div>
                                <span id="card-error"></span>
                                <br>

                            <?php
                            if($status == 0){
                                ?>
                            <button class="theme_btn submit" type="button" data-rank="<?php echo $rank;?>">Pay</button>
                            <?php
                            }
                            ?>
                            </div>
                            <div class="paypal_button" style="display:none">
                                
                                <?php
                            if($status == 0){
                                ?>
                            <div id="smart-button-container">
                                    <div style="text-align: center;">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            </div>
                            <div class="apple_btn" >
                                <div id="payment-request-button">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>
                            <!-- <p class="mb-0 text-center text-danger alert_msg"></p> -->
                            
                            <!-- -->
                            <?php
                            if($status != 0){
                                ?>
                                <button type="button" data-rank="<?php echo $rank;?>" disabled class="next theme_btn">Payed</button>
                            <?php
                            }
                            ?>
                            <!--  -->
                        </form>
                    </div>
                </div>
                <!-- share start -->
            </div>
            <!-- Thank you end -->
        </div>
        <!-- container start -->
    </div>
    <!-- .banner end -->
    <!-- JS, Popper.js, and jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AcJ-QxT9yPGSiFanSm-fA4tVvmtZIHHc5j6rirOkLAZZP4yAsvuHCzZHeaddJvnDf79IeGAhi0889lHa&disable-funding=credit,card&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script src="js/client.js" defer></script>
    <script src="js/script.js"></script>
 
</body>

</html>