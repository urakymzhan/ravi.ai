<?php
require "server.php";
$email = "";
$rank = "0";
$status=0;

/**
 * Get last user email
 */

if(isset($_SESSION['email'])){
    $rank = $_SESSION['rank'];
    $email = $_SESSION['email'];
    $new_user = $rank;

    $qry = "SELECT * FROM user_data WHERE u_email='$email'";
    $res=$conn->query($qry);
    $row = $res->fetch_assoc();
    // $email= $row['u_email'];
    $status = $row['u_task_form'];
    // $qry2 = "SELECT * FROM user_data WHERE u_rank='$rank'";
    // $res2=$conn->query($qry2);
    // $row2 = $res2->fetch_assoc();
    // $email2=$row2['u_email'];
}
$qry2="SELECT * FROM list_init WHERE init_id=1";
$res2=$conn->query($qry2);
$row2=$res2->fetch_assoc();
// Current user
$last_user_email = $email; 

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
    <!-- banner start -->
    <div class="banner">
        <!-- container start -->
        <div class="container">
            <div class="banner_box">
                <img src="img/logo.png" alt="img" class="img-fluid">
                <h1><a href="#">rav.ai</a> professional short form videos stop wasting time editing</h1>
                <form>
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <button type="submit">Get Early Access</button>
                </form>
            </div>
            <!-- Thank you start -->
            <div class="thank_you text-center">
                <div class="thank_top">
                    <h2>Congrats!</h2>
                    <p>You’ve jumped <b><?php echo number_format($row2['init_email']-$rank); ?></b> spots</p>
                </div>
                <div class="box">
                    <h3><strong><?php echo number_format($rank-1); ?></strong> People ahead of you</h3>
                    <h4>This reservation is held for
                    <a href="mailto: <?php if($last_user_email != ""){ echo $last_user_email; }else{ echo "thebest@gmail.com";} ?>"><?php if($last_user_email != ""){ echo $last_user_email; }else{ echo "thebest@gmail.com";} ?></a>.
                            <br><a>not you?</a>
                    </h4>
                </div>
                <div class="thank_access">
                    <h4 class="mb-3">Get even earlier access?</h4>

                    <form class="text-left" id="social_form">


                        <div class="form-group">
                            <label for="ControlSelect1">What is your social platform?</label>
                            <select class="form-control" id="ControlSelect1" required>
                                <option selected disabled>Select your social platform</option>
                                <option value="Instagram">Instagram</option>
                                <option value="YouTube">YouTube</option>
                                <option value="TikTok">TikTok</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="OnlyFans">OnlyFans</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ControlSelect2">Category?</label>
                            <select class="form-control" id="ControlSelect2" required>
                                <option selected disabled>Select your social platform</option>
                                <option value="Animals">Animals</option>
                                <option value="Beauty">Beauty</option>
                                <option value="Business">Business</option>
                                <option value="DIY">DIY</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Family">Family</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Fitness">Fitness</option>
                                <option value="Food">Food</option>
                                <option value="Games">Games</option>
                                <option value="General">General</option>
                                <option value="Health">Health</option>
                                <option value="Lifestyle">Lifestyle</option>
                                <option value="Music">Music</option>
                                <option value="Parenting">Parenting</option>
                                <option value="Photography">Photography</option>
                                <option value="Sports">Sports</option>
                                <option value="Technology">Technology</option>
                                <option value="Travel">Travel</option>
                                <option value="Traveling">Traveling</option>
                                <option value="Video">Video</option>
                                
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="ControlSelect3">What is your social handle?</label>
                            <input type="text" id="ControlSelect3" class="form-control" placeholder="Fill-In Box" required>
                        </div>
                        <?php
                            if($status == 0){
                                ?>
                        <button type="submit" data-rank="<?php echo $rank;?>">Submit</button>
                        <?php
                            }else{
                                ?>
                        <button type="button" data-rank="<?php echo $rank;?>" class="next">Submit</button>
                        <?php
                            }
                            ?>



                    </form>

                </div>
                <!-- share start -->

            </div>
            <!-- Thank you end -->
        </div>
        <!-- container start -->
    </div>
    <!-- banner end -->
    <!-- JS, Popper.js, and jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script>
    $(document).ready(function() {
        $('#social_form').submit(function(e) {
            e.preventDefault();
            let a1 = $('#ControlSelect1').val();
            let a2 = $('#ControlSelect2').val();
            let a3 = $('#ControlSelect3').val();
            let rank = $(this).find('button').data('rank');
            if(a1==null){
                a1=0;
            }
            if(a2 ==null){
                a2=0;
            }
            if(a3==""){
                a3=0;
            }
            $.ajax({
                url:"server.php",
                type:"POST",
                data:{
                    action:'form',
                    rank:rank,
                    a1:a1,
                    a2:a2,
                    a3:a3
                },
                success:function(res){
                    window.location.href=`index3.php`;
                }
            });
        });

        $('.next').click(function(){
            let rank = $(this).data('rank');
            window.location.href=`index3.php`;

        });
    });
    </script>
</body>

</html>