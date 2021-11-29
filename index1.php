<?php
require "server.php";
$email = "";
$rank = "0";
$status=0;

/* Get last user email*/
$last_user_query = "SELECT * FROM user_data ORDER BY u_id DESC LIMIT 2";
$last_user_res = $conn->query($last_user_query);

// remove
print_r("last_user_res");
print_r($last_user_res);

while($last_user_row = $last_user_res->fetch_assoc()){
    $last_user_email = $last_user_row['u_email']; 
}
// remove
print_r("last_user_email");
print_r($last_user_email);

// Check if existed user
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
    $status = $row['u_task_share']; // 0
    $token=$row['u_reffral'];
    $url="https://rav.ai/index.php?ref=$token";
    // reffral_link
    // $qry2 = "SELECT * FROM user_data WHERE u_rank='$rank'";
    // $res2=$conn->query($qry2);
    // $row2 = $res2->fetch_assoc();
    // $token2=$row2['u_reffral'];
    // $email2=$row2['u_email'];
    // $url="https://rav.ai/index.php?ref=$token2";
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
    <meta name="description" content="Making social media videos is easier now, because Rav.Ai handles the editing for you.">
    <meta name="keywords" content="Social media videos, reel, shorts">
    <meta name="author" content="Rav.ai">
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="canonical" href="https://rav.ai/">

    <meta property="og:url" content="https://rav.ai/">
    <meta property="og:site_name" content="Rav.ai">
    <meta property="og:image" content="https://rav.ai/img/sharer-bg.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1366">
    <meta property="og:image:height" content="657">

    <meta property="twitter:creator" content="Rav.ai">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Rav.ai">
    <meta property="twitter:description" content="Making social media videos is easier now, because Rav.Ai handles the editing for you.">
    <meta property="twitter:image:src" content="https://rav.ai/img/sharer-bg.png">
    <meta property="twitter:image:width" content="1366">
    <meta property="twitter:image:height" content="657">

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
                <div class="thank_top pb-2">
                    <h2>Thank you!</h2>
                </div>
                <div class="box">
                    <h3><strong><?php echo number_format($rank-1); ?></strong> People ahead of you</h3>
                    <h4>This reservation is held for
                        <a href="mailto: <?php if($last_user_email != ""){ echo $last_user_email; }else{ echo "thebest@gmail.com";} ?>"><?php if($last_user_email != ""){ echo $last_user_email; }else{ echo "thebest@gmail.com";} ?></a>.
                        <br><a>not you?</a>
                    </h4>
                </div>
                <div class="thank_access">
                    <h4>Get even earlier access?</h4>
                    <p>The more friends that join, the sooner you’ll get access.</p>
                </div>
                <!-- share start -->
                <!-- thank share start -->
                <div class="thank_share">
                    <ul>
                        <li>
                             <button class="button" data-sharer="twitter" data-title="I signed up for Rav.ai so I never have to edit a video for social media again. Sign up now and help me get access faster."
                            
                                data-hashtags="awesome,Rav.ai"
                                data-url="<?php echo $url; ?>"><i
                                    class="fab fa-twitter"></i> Tweet</button> 
                                   
                        </li>
                        <li>
                            <button class="button" data-sharer="facebook" data-hashtag="Rav.ai"
                            data-image="https://rav.ai/img/logo.png"
                                data-url="<?php echo $url; ?>"><i class="fab fa-facebook-f"></i>
                                Share</button>
                        </li>
                        <li>
                            <button class="ig-share-button"><i class="fab fa-instagram"></i>Share</button>
                        </li>
                        <li>
                            <button class="button" data-sharer="email"
                            data-image="https://rav.ai/img/logo.png"
                            data-title="Awesome Url"
                            
                                data-url="<?php echo $url; ?>" data-subject="I wanted to share Rav.Ai with you. Making social media videos is easier now, because Rav.Ai handles the editing for you."
                                data-to="some@email.com"><i class="fas fa-envelope"></i> Email</button>
                        </li>
                        <li>
                            <button class="button" data-sharer="linkedin"
                            data-image="https://rav.ai/img/logo.png"
                                data-url="<?php echo $url; ?>"><i class="fab fa-linkedin-in"></i>
                                Share</button>
                        </li>
                    </ul>
                    <h4>Or Share this unique link:</h4>
                    <p class="reffral_link_clipboard" id="textToCopy" data-toggle="tooltip" data-placement="right" title="Copy to clipboard"><?php echo $url; ?></p>
                    <br>
                    <?php if($status == 0){
                        ?>
                        <button class="theme_btn continue" data-rank="<?php echo $rank; ?>">Continue <i
                        class="fa fa-chevron-right"></i></button>
                        <?php
                    } else{
                        ?>
                        <button class="theme_btn next" data-rank="<?php echo $rank; ?>">Continue <i
                        class="fa fa-chevron-right"></i></button>
                        <?php
                    } ?>
                    <p class="alert_box"></p>
                </div>
                <!-- thank share end -->
            </div>
            <!-- Thank you end -->
        </div>
        <!-- container start -->
    </div>
    <!-- .banner end -->
    <!-- JS, Popper.js, and jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>

    <script>



    function download(file) {
        //creating an invisible element
        var element = document.createElement("a");
        element.setAttribute("href", "img/sharer-bg.png");
        element.setAttribute("download", file);

        // Above code is equivalent to
        // <a href="path of file" download="file name">

        document.body.appendChild(element);

        //onClick property
        element.click();

        document.body.removeChild(element);
    }
    $(document).ready(function() {
        let shareCount = 0;
        $('.thank_share ul li button').click(function() {
            shareCount++;
        });
        $('.ig-share-button').click(function() {
            let x = Math.floor((Math.random() * 100) + 1);
            let filename = 'ravai-post-' + x;
              
            download(filename);
            window.location.href=`howtoshare.php`;
        });
        $('.continue').click(function() {
            
            let alert_box=$('.alert_box');
            alert_box.html("");
            let rank = $(this).data('rank');

            if (shareCount >= 2 && rank != "0") {
                $.ajax({
                    url: "server.php",
                    type: "POST",
                    data: {
                        action: 'share',
                        rank: rank
                    },
                    success: function(res) {
                        window.location.href=`index5.php`;
                    }
                });
            }else{
                alert_box.html("Please share atleast on two platforms");
            }
        });
        $('.next').click(function() {
            // let rank = $(this).data('rank');
            window.location.href=`index5.php`;
        });
    });
    </script>
</body>

</html>