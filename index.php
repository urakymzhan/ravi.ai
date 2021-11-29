<?php 
// require 'config.php';
require 'server.php';
    if(isset($_GET['ref']))
    {
        $_SESSION['reffral_id']=$_GET['ref'];
    }else{
        $_SESSION['reffral_id']=NULL;
    }

    $google_login_url=$google_client->createAuthUrl();
    $permission=['email'];
    $fb_login_url = $fb_helper->getLoginUrl(FB_BASE_URL,$permission);
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
                <h1><a href="#">rav.ai</a> your videos created in minutes stop wasting time editing</h1>
                <form action="server.php" method="POST">
                    <button type="submit">Get Early Access</button>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </form>
                
                <div class="social_media text-center">
                    <p class="mb-0 pt-3 pb-2">OR</p>
                    <a href="<?php echo $google_login_url; ?>"><i class="fab fa-google"></i></a>
                    <a href="<?php echo $fb_login_url; ?>"><i class="fab fa-facebook-f"></i></a>
                </div>
                <div class="row text-center py-3 text-white video_link">
                    <div class="col">
                        <a href="https://www.youtube.com/watch?v=UomkBsvQis0" data-target="_blank">Watch the Video <i class="far fa-play-circle fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- container start -->
    </div>
    <!-- .banner end -->

    <!-- JS, Popper.js, and jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>