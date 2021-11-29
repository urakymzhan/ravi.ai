<?php
require "server.php";
$email = "";
$rank = "0";
$status=0;

/* Get last user email*/

$last_user_query = "SELECT * FROM user_data ORDER BY u_id DESC LIMIT 2";
$last_user_res = $conn->query($last_user_query);

while($last_user_row = $last_user_res->fetch_assoc()){
    $last_user_email = $last_user_row['u_email']; 
}

if(isset($_SESSION['email'])){
    $rank = $_SESSION['rank'];
    $email = $_SESSION['email'];
    // $new_user = $rank;
    $qry = "SELECT * FROM user_data WHERE u_email='$email'";
    $res=$conn->query($qry);
    $row = $res->fetch_assoc();
    // $email= $row['u_email'];
    $status = $row['u_task_share'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/fontawesome.min.css" integrity="sha512-Rcr1oG0XvqZI1yv1HIg9LgZVDEhf2AHjv+9AuD1JXWGLzlkoKDVvE925qySLcEywpMAYA/rkg296MkvqBF07Yw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            </div>
            <!-- Thank you start -->
            <div class="thank_you">
                <div class="thank_top thank_share">
                    <h2 class=" text-center">How to share to Instagram</h2>
                    <div class="p-10t">
                        <ol>
                            <li>
                                <p>Head over to <a href="https://www.instagram.com" target="__blank">Instagram</a></p>
                            </li>
                            <li>
                                <p>Share the already downloaded image to your feed or story</p>
                            </li>
                            <li>
                                <p>Copy the link below to add as caption to your post</p>
                                <div class="row">
                                  <div class="col-8">
                                    <input type="text" id="url" class="form-control" name="url" value="<?php echo $url; ?>" disabled>
                                  </div>
                                  <div class="col-4">
                                    <button class="btn btn-success share-button">Copy</button>
                                  </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
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
    <script src="js/FileSaver.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.share-button').click(function() {
          /* Get the text field */
          var copyText = document.getElementById("url");

          /* Select the text field */
          copyText.select();
          copyText.setSelectionRange(0, 99999); /* For mobile devices */

           /* Copy the text inside the text field */
          navigator.clipboard.writeText(copyText.value);
        })
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>