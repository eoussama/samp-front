<?php
    /**
     * @name:       Samp Front
     * @version:    0.2.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     */

    // Requiring all dependencies.
    require_once "../config/Database.php";
    require_once "../config/config.php";
    require_once "../models/News.php";

    // Instantiating a new Database object.
    $db   = new Database();

    // Creating a connection object.
    $conn = $db->connect();

    // Instantiating a new News object.
    $news = new News($conn);

    // Loading the website's configurations.
    $config = unserialize(CONFIG);

    // Setting up the $inverted string, used to make the dark mode
    // work if enabled.
    $inverted = $config['darkMode'] ? 'inverted' : '';
?>

<!DOCTYPE html>

<html lang="en">
    <head>

        <!-- The meta data. -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="EOussama">
        <meta name="application-name" content="Samp Front">
        <meta name="description" content="A starter landing page template for samp servers.">
        <meta name="keywords" content="template, landing-page, samp, samp-server, samp-website">
        
        <!-- Semantic UI. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

        <!-- The main stylesheet. -->
        <link rel="stylesheet" href="../assets/css/loader.css">
        <link rel="stylesheet" href="../assets/css/dashboard/dashboard.css">

        <!-- The website's favicon. -->
        <link rel="shortcut icon" type="image/png" href="../assets/img/logo.png">

        <!-- The website's title -->
        <title><?php echo $config['name']; ?></title>
    </head>
   
    <body class="<?php echo $config['darkMode'] ? "dark" : "";  ?>">
        
        <!-- The burger button's menu. -->
        <nav class="ui <?php echo $inverted; ?> borderless top attached menu">
            <a class="item" id="burger-btn">
                <i class="sidebar icon"></i>
            </a>

            <div class="item">
                <b>Dashboard</b>
            </div>
        </nav>

        <!-- The loader. -->
        <div id="loader" class="ui inverted active dimmer">
            <div class="ui text loader"><?php echo $config['name']; ?></div>
        </div>

        <!-- The page's content -->
        <div id="context" class="ui bottom attached segment pushable">

            <!-- The sidebar. -->
            <aside id="sidebar" class="ui <?php echo $inverted; ?> labeled icon left inline vertical sidebar menu">
                <a class="item" href="./../index.php">
                    <i class="home icon"></i>
                    Home
                </a>
                <a class="item" id="news-btn">
                    <i class="block layout icon"></i>
                    News
                </a>
            </aside>

            <!-- Actuall content -->
            <div class="pusher">
                <main class="ui container">
                    <div class="ui grid">

                        <!-- News. -->
                        <section id="news" class="ui row grid">

                            <!-- Title. -->
                            <div class="row">
                                <div class="column">
                                    <h1 class="ui header">
                                        <i class="block layout icon"></i>
                                        News [<?php echo $news->count(); ?>]
                                    </h1>

                                    <div class="ui divider"></div>
                                </div>                            
                            </div>

                            <div class="row">

                                <!-- News list. -->
                                <div class="twelve wide column">
                                    <div class="ui <?php echo $inverted; ?> relaxed divided selection list">
                                        <?php 
                                            $articles = $news->read_all();

                                            if($articles->rowCount() > 0) {
                                                while($article = $articles->fetch(PDO::FETCH_ASSOC)) {
                                                    extract($article);
                                                    
                                                    echo '
                                                        <label class="item" data-id="' . $id . '">
                                                            <div class="ui checkbox">
                                                                <input id="' . $id . '" type="checkbox" tabindex="0" class="hidden">
                                                                <label for="' . $id . '" class="content">
                                                                    <div class="header">' . $title . '</div>
                                                                    <small>Article ID: <b>' . $id . '</b></small>
                                                                </label>
                                                            </div>
                                                        </label>
                                                    ';
                                                }
                                            }
                                        ?>                                            
                                    </div>
                                </div>

                                <!-- News controls. -->
                                <div class="four wide column">
                                    <div class="ui <?php echo $inverted; ?> selection list">
                                        <div class="item">
                                            <div class="content">
                                                <div class="header">
                                                    <i class="plus circle icon"></i>
                                                    Add a new news article
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="content">
                                                <div class="header">
                                                    <i class="check circle icon"></i>
                                                    Select all news articles
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="content">
                                                <div class="header">
                                                    <i class="circle outline icon"></i>
                                                    Unselect all news articles
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="content">
                                                <div class="header">
                                                    <i class="times circle icon"></i>
                                                    Delete selected news articles
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </div>

        <!-- JQuery. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Semantic UI. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

        <!-- The main script -->
        <script src="../assets/js/dashboard/dashboard.js"></script>
    </body>
</html>