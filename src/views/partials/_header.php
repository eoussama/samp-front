<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="EOussama">
        <meta name="application-name" content="Samp Front">
        <meta name="description" content="A starter landing page template for samp servers.">
        <meta name="keywords" content="template, landing-page, samp, samp-server, samp-website">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
        <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
        <link rel="stylesheet" href="assets/css/main.css">

        <title><?php echo SERVER_NAME; ?></title>
    </head>

    <body>
        <div class="ui stackable borderless menu">
            <div class="ui container">
                <div class="left menu">
                    <a href="<?php echo $_SERVER['PHP_SELF'] ?>" class="item">
                        <img class="ui avatar image" src="./assets/img/logo.png">
                        <span> <?php echo SERVER_NAME; ?> <span>
                    </a>
                </div>

                <div class="right menu">
                    <a class="item">Home</a>
                    <a href="<?php echo FORUM_URL; ?>" class="item">Forum</a>
                    <a class="item">Live stats</a>
                    <a class="item">News</a>
                    <a class="item">Gallery</a>
                    <a class="item">About</a>
                    <a class="item">Donate</a>
                </div>
            </div>
        </div>