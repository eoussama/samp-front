<?php

    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     * 
     * This is the index file of the website, the front and the entry point, also, the
     * only page that the average user should interact with.
     */

    /**
     * Only disable errors if you're pushing this into a production environment.
     * In order to disable it, change `E_ALL` to `0`.
     */
    error_reporting(E_ALL);

    // Requiring the configurations.
    require_once "./../config/config.php";

    // Loading the configurations.
    $config = unserialize(CONFIG);

    // Requiring all dependencies.
    require_once pathfy('models') . "Database.php";
    require_once pathfy('models') . "News.php";
    require_once pathfy('lib') . "SampQueryAPI.php";
    require_once pathfy('helpers') . "icons.php";

    // Instantiating a new Database object.
    $db   = new Database(
        $config['database']['host'],
        $config['database']['name'],
        $config['database']['user'],
        $config['database']['pass']
    );

    // Creating a connection object.
    $conn = $db->connect();

    // Instantiating a new News object.
    $news = new News($conn, $config['database']['newsTable']);

    /**
     * Only uncomment this if you want to seed some
     * dummy articles in your database for testing purposes.
     */
    // $news->seed();

    // Connecting to the SA:MP server associated with the website.
    $query = new SampQueryAPI($config['samp']['ip'], $config['samp']['port']);
    $isOnline = $query->isOnline();

    // Setting up the $inverted string, used to make the dark mode
    // work if enabled.
    $inverted = $config['website']['darkMode'] ? 'inverted' : '';

    $discordTheme = ($config['discord']['autoMatch'] ? ($config['website']['darkMode'] ? "dark" : "light") : $config['discord']['theme']);
?>

<!DOCTYPE html>

<html lang="en">
    <head>

        <!-- The meta data. -->
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="<?php echo $config['general']['owner']; ?>">
        <meta name="application-name" content="<?php echo $config['general']['name']; ?>">
        <meta name="description" content="<?php echo $config['general']['slogan']; ?>">
        <meta name="keywords" content="<?php echo join(', ', $config['general']['keywords']); ?>">
        
        <!-- Semantic UI. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

        <!-- Slick. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
        
        <!-- The main stylesheet. -->
        <link rel="stylesheet" href="<?php echo pathfy('css', 'site', true) ?>loader.css">
        <link rel="stylesheet" href="<?php echo pathfy('css', 'site', true) ?>main/header.css">
        <link rel="stylesheet" href="<?php echo pathfy('css', 'site', true) ?>main/main.css">
        <link rel="stylesheet" href="<?php echo pathfy('css', 'site', true) ?>main/footer.css">

        <!-- The website's favicon. -->
        <link rel="shortcut icon" type="image/png" href="<?php echo pathfy('img', 'site', true) ?>logo.png">

        <!-- The website's title -->
        <title><?php echo $config['general']['name']; ?></title>
    </head>

    <body class="<?php echo $config['website']['darkMode'] ? "dark" : "";  ?>">

        <!-- The loader. -->
        <div id="loader" class="ui inverted active dimmer">
            <div class="ui text loader"><?php echo $config['general']['name']; ?></div>
        </div>

        <!-- The navbar. -->
        <nav class="ui <?php echo $inverted; ?> stackable borderless menu">
            <div class="ui container">

                <!-- The community's logo. -->
                <div class="left menu">
                    <a class="item" href="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <img class="ui avatar image" src="<?php echo pathfy('img', 'site', true); ?>logo.png">
                        <span class="community-name"> <?php echo $config['general']['name']; ?> <span>
                    </a>
                </div>

                <!-- The reset of the links. -->
                <div class="right menu">
                    <a class="item" href="<?php echo pathfy('views', 'site', true); ?>dashboard.php">Dashboard</a>
                    <a class="item" href="<?php echo $config['website']['links']['forum']; ?>">Forum</a>
                    <a class="item" id="live-stats-btn">Live stats</a>
                    <a class="item" id="news-btn">News</a>
                    <a class="item" id="gallery-btn">Gallery</a>
                    <a class="item" id="about-btn">About</a>
                    <a class="item" href="<?php echo $config['website']['links']['donation']; ?>">Donate</a>
                </div>
            </div>
        </nav>

        <!-- Fullscreen image container. -->
        <div id="fullscreen-container" class="ui page dimmer">
            <i id="fullscreen-close-btn" class="big inverted close icon"></i>
            <div class="content">
                <img src="" alt="No image" class="ui rounded fluid image">
            </div>
        </div>

        <!-- The header. -->
        <header class="ui vertical center aligned segment">
            <div class="ui container">

                <!-- Community name -->
                <h1 class="ui header"><?php echo $config['general']['name']; ?></h1>

                <!-- Community slogan. -->
                <h4 class="ui grey header"><?php echo $config['general']['slogan']; ?></h4>

                <!-- Scroll down button. -->
                <p class="icon-wrapper">
                    <i id="scroll-down-btn" class="grey huge angle down icon"></i>
                </p>
            </div>
        </header>

        <!-- The main content. -->
        <main class="ui container">
            <div class="ui stackable grid">

                <!-- Introduction row. -->
                <div class="row">
                    <section id="intro" class="column">
                        <div class="ui segment">
                            <div class="ui grid">
                                <div id="fellas" class="three wide column">
                                    <img src="assets/img/figures/fellas.png" alt="Who we are image.">
                                </div>
                                <div id="intro-content" class="thirteen wide column">
                                    <h3>Who we are</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut voluptatem culpa, obcaecati nam esse voluptatum laudantium omnis aspernatur minus non repellat exercitationem facilis fuga ab recusandae reprehenderit molestias? Deleniti, ea!</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut voluptatem culpa, obcaecati nam esse voluptatum laudantium omnis aspernatur minus non repellat exercitationem facilis fuga ab recusandae reprehenderit molestias? Deleniti, ea!</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut voluptatem culpa, obcaecati nam esse voluptatum laudantium omnis aspernatur minus non repellat exercitationem facilis fuga ab recusandae reprehenderit molestias? Deleniti, ea!</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Live stats. -->
                <div id="live-stats" class="row">

                    <!-- Server live stats. -->
                    <section class="eleven wide column">
                        <div class="ui segment">
                            <h3>Live stats</h3>
                            <div class="ui two column grid">

                                <!-- Actuall stats -->
                                <div id="server-live-stats" class="twelve wide column <?php  echo ($isOnline ? '' : 'offline'); ?>">
                                    <table class="ui table">
                                        <tbody id="server-stats-content">
                                            <?php
                                                if ($isOnline) {
                                                    $server_info = $query->getInfo();
                                                    $server_rules = $query->getRules();
                                                }
                                            ?>

                                            <!-- Hostname. -->
                                            <tr>
                                                <td class="collapsing">
                                                    <i class="star icon"></i> Host name
                                                </td>
                                                <td id="server-hostname">
                                                    <?php
                                                        if ($isOnline) {
                                                            echo $server_info['hostname'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <!-- Version. -->
                                            <tr>
                                                <td class="collapsing">
                                                    <i class="circle icon"></i> Version
                                                </td>
                                                <td id="server-version">
                                                    <?php
                                                        if ($isOnline) {
                                                            echo $server_rules['version'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <!-- Gamemode. -->
                                            <tr>
                                                <td class="collapsing">
                                                    <i class="play icon"></i> Game-mode
                                                </td>
                                                <td id="server-gamemode">
                                                    <?php
                                                        if ($isOnline) {
                                                            echo $server_info['gamemode'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <!-- Map. -->
                                            <tr>
                                                <td class="collapsing">
                                                    <i class="map icon"></i> Map
                                                </td>
                                                <td id="server-mapname">
                                                    <?php
                                                        if ($isOnline) {
                                                            echo $server_rules['mapname'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <!-- Language. -->
                                            <tr>
                                                <td class="collapsing">
                                                    <i class="globe icon"></i> Language
                                                </td>
                                                <td id="server-language">
                                                    <?php
                                                        if ($isOnline) {
                                                            echo $server_info['mapname'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <!-- Players. -->
                                            <tr>
                                                <td class="collapsing">
                                                    <i class="user icon"></i> Players
                                                </td>
                                                <td id="server-players">
                                                    <?php
                                                        if ($isOnline) {
                                                            echo $server_info['players']. " / " .$server_info['maxplayers'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <!-- Password. -->
                                            <tr>
                                                <td class="collapsing">
                                                    <i class="lock icon"></i> Password
                                                </td>
                                                <td id="server-password">
                                                    <?php
                                                        if ($isOnline) {
                                                            echo $server_info['password'] == 0 ? "No" : "Yes";
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="server-offline">
                                        <i class="huge exclamation icon"></i>
                                        <p>The server is currently offline</p>
                                    </div>
                                </div>

                                <!-- Officer tempany. -->
                                <div class="four wide column">
                                    <img id="office-tempany" src="assets/img/figures/tempeny-1.png" alt="Live stats figure.">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Players live stats. -->
                    <section id="players-stats" class="five wide column <?php  echo ($isOnline ? '' : 'offline'); ?>">
                        <div class="ui segment">
                            <?php
                                if ($isOnline) {
                                    $players = $query->getDetailedPlayers();
                                }
                            ?>

                            <div class="content">
                                <h3>Players
                                    <span id="player-count">
                                        <?php
                                            if ($isOnline) {
                                                echo count($players) . " / " . $server_info['maxplayers'];
                                            }
                                        ?>
                                    </span>
                                </h3>
    
                                <table class="ui <?php echo $inverted; ?> table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Player name</th>
                                            <th>Score</th>
                                            <th>Ping</th>
                                        </tr>
                                    </thead>
                                </table>
    
                                <!-- Actuall stats -->
                                <div id="players-live-stats" class="twelve wide column">
                                    <table class="ui celled table">
                                        <tbody id="player-stats-content">
                                            <?php if ($isOnline): ?>
                                                <?php foreach($players as $player): ?>
                                                    <tr>
                                                        <td><?php echo $player['playerid']; ?></td>
                                                        <td><?php echo $player['nickname']; ?></td>
                                                        <td><?php echo $player['score']; ?></td>
                                                        <td><?php echo $player['ping']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="server-offline">
                                <i class="huge exclamation icon"></i>
                                <p>The server is currently offline</p>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- News. -->
                <div class="row">
                    <section id="news" class="sixteen wide column">
                        <div class="ui segment">
                            <h3>News</h3>

                            <div class="ui grid">
                                <?php if($news->count() > 0): ?>

                                    <!-- News preview. -->
                                    <div class="ten wide column">
                                        <div id="news-content" class="ui segment">
                                            <h2 id="news-title"></h2>
                                            <small id="news-date"></small>

                                            <div class="ui divider"></div>

                                            <p id="news-body"></p>
                                        </div>
                                    </div>

                                    <!-- News list. -->
                                    <div class="six wide column">
                                        <div id="news-list" class="ui segment">
                                            <div class="ui <?php echo $inverted; ?> relaxed divided selection list">
                                                <?php 
                                                    $articles = $news->read_all();

                                                    if($articles->rowCount() > 0) {
                                                        while($article = $articles->fetch(PDO::FETCH_ASSOC)) {
                                                            extract($article);

                                                            echo '
                                                                <div class="item" data-id="' . $id . '">
                                                                    <div class="content">
                                                                        <div class="header">' . $title . '</div>
                                                                        <small>' . $created_at_formated . '</small>
                                                                    </div>
                                                                </div>
                                                            ';
                                                        }
                                                    }
                                                ?>                                            
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div id="no-articles">
                                        <i class="huge exclamation icon"></i>
                                        <p>Such empty!</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Misc. -->
                <div class="row">

                    <!-- Gallery. -->
                    <section class="eleven wide column">
                        <div id="gallery" class="ui segment">
                            <h3>Gallery</h3>

                            <i class="big <?php echo $inverted; ?> expand icon" id="fullscreen-btn"></i>

                            <div id="gallery-carousel">
                                <img src="assets/img/gallery/1.jpg" alt="A cop arresting a robber.">
                                <img src="assets/img/gallery/2.jpg" alt="A water tank knocking down robbers.">
                                <img src="assets/img/gallery/3.jpg" alt="Tram highjack.">
                                <img src="assets/img/gallery/4.jpg" alt="Parachute dive.">
                                <img src="assets/img/gallery/5.jpg" alt="Helicopter patrol.">
                                <img src="assets/img/gallery/6.jpg" alt="Gas station confrontation.">
                                <img src="assets/img/gallery/7.jpg" alt="Las Venturas hot pursuit.">
                                <img src="assets/img/gallery/8.jpg" alt="Police trail.">
                                <img src="assets/img/gallery/9.jpg" alt="Sneak attack.">
                            </div>
                        </div>
                    </section>

                    <!-- Discord section. -->
                    <section id="discord" class="five wide column">
                        <div class="ui segment discord-section">
                            <iframe src="https://discordapp.com/widget?id=<?php echo $config['discord']['id']; ?>&theme=<?php echo $discordTheme; ?>" height="500" allowtransparency="true" frameborder="0"></iframe>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <!-- Scroll to top button. -->
        <div id="scroll-top">
            <i class="huge <?php echo $inverted; ?> angle up icon"></i>
        </div>
        
        <!-- The footer. -->
        <footer class="ui placeholder segment">
            <div class="ui stackable grid container">

                <!-- The about section. -->
                <div id="about" class="twelve wide column">
                    <div class="ui big header">About</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit voluptates eligendi nostrum consectetur laudantium, labore corrupti saepe eveniet incidunt fugit optio ratione sequi possimus ut reiciendis facilis, tempora quod eius iste architecto. Minima, iste! Nemo reiciendis, fugiat facilis saepe illum, fugit repudiandae rem quia officiis, corrupti eos iure libero expedita voluptate! Sit animi magni illo soluta dolorum veniam, at laborum itaque inventore recusandae repellendus, hic dicta tempora, architecto sint. Odio odit aliquam nihil doloribus, delectus iste sapiente eius commodi maxime magnam eligendi reiciendis aperiam dolorum facere consectetur voluptatibus ducimus, veritatis amet iusto. Tempora eligendi recusandae cum voluptatem, aut eum facere deleniti suscipit hic optio. Excepturi, commodi quae. Nisi dolorem quae ipsam cupiditate sint voluptate, autem itaque aliquid ad repellendus possimus adipisci facilis sapiente, inventore porro doloribus blanditiis temporibus, excepturi architecto ducimus velit sit amet. Blanditiis, debitis, reiciendis assumenda odit maxime iusto illo dolor dignissimos veritatis cumque, aspernatur porro ut excepturi!</p>
                </div>

                <!-- The community's links -->
                <div class="four wide column">
                    <div class="ui big header">Community links</div>

                    <div class="ui middle aligned animated relaxed list">
                        <?php foreach($config['website']['links'] as $label => $link): ?>
                            <?php if ($label != "donation"): ?>
                                <div class="item">
                                    <i class="large <?php echo get_icon($label); ?> icon"></i>
                                    <div class="content">
                                        <a href="<?php echo $link; ?>" target="_blank">
                                            <div class="header community-link-label"><?php echo $label; ?></div>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Trademark -->
            <div class="ui segment trademark">
                <small>
                    <a href="https://github.com/EOussama/samp-front">Samp Front</a> by <a href="https://github.com/EOussama">EOussama</a>
                </small>
            </div>
        </footer>
        
        <!-- JQuery. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Semantic UI. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

        <!-- Scrollreveal. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.5/scrollreveal.min.js"></script>

        <!-- Slick. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

        <!-- The main script -->
        <script src="<?php echo pathfy('js', 'site', true) ?>main/main.js"></script>
        <script src="<?php echo pathfy('js', 'site', true) ?>main/scrollreveal.js"></script>
    </body>
</html>
