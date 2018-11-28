<!DOCTYPE html>

<html lang="en">
    <head>

        <!-- The meta data -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="EOussama">
        <meta name="application-name" content="Samp Front">
        <meta name="description" content="A starter landing page template for samp servers.">
        <meta name="keywords" content="template, landing-page, samp, samp-server, samp-website">
        
        <!-- Semantic UI. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

        <!-- Slick. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
        
        <!-- The main stylesheet. -->
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/footer.css">

        <!-- The website's favicon. -->
        <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">

        <!-- The website's title -->
        <title><?php echo $config['name']; ?></title>
    </head>

    <body>
        <div id="loader" class="ui inverted active dimmer">
            <div class="ui text loader"><?php echo $config['name']; ?></div>
        </div>

        <!-- The navbar. -->
        <nav class="ui stackable borderless menu">
            <div class="ui container">

                <!-- The community's logo. -->
                <div class="left menu">
                    <a class="item" href="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <img class="ui avatar image" src="./assets/img/logo.png">
                        <span class="community-name"> <?php echo $config['name']; ?> <span>
                    </a>
                </div>

                <!-- The reset of the links. -->
                <div class="right menu">
                    <a class="item" href="<?php echo $config['links']['community']['forum']; ?>">Forum</a>
                    <a class="item" id="live-stats-btn">Live stats</a>
                    <a class="item">News</a>
                    <a class="item">Gallery</a>
                    <a class="item" id="about-btn">About</a>
                    <a class="item" href="<?php echo $config['links']['donation']; ?>">Donate</a>
                </div>
            </div>
        </nav>
