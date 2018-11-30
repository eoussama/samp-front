<?php
    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     */

    // Requiring all dependencies.
    require_once "./../config/Database.php";
    require_once "./../config/config.php";
    require_once "./../models/News.php";

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

        <!-- Quill -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.min.css">

        <!-- The main stylesheet. -->
        <link rel="stylesheet" href="<?php echo $config['root']; ?>/assets/css/loader.css">
        <link rel="stylesheet" href="<?php echo $config['root']; ?>/assets/css/dashboard/dashboard.css">

        <!-- The website's favicon. -->
        <link rel="shortcut icon" type="image/png" href="<?php echo $config['root']; ?>/assets/img/logo.png">

        <!-- The website's title -->
        <title><?php echo $config['name']; ?></title>
    </head>
   
    <body class="<?php echo $config['darkMode'] ? "dark" : "";  ?>">
        
        <!-- The burger button's menu. -->
        <nav class="ui <?php echo $inverted; ?> borderless top fixed menu">
            <a class="item" href="<?php echo $config['root']; ?>/index.php">
                <b>Home</b>
            </a>

            <a class="item" href="<?php echo $_SERVER['PHP_SELF']; ?>">
                <b>Dashboard</b>
            </a>
        </nav>

        <!-- The loader. -->
        <div id="loader" class="ui <?php echo $inverted; ?> active dimmer">
            <div class="ui text loader"><?php echo $config['name']; ?></div>
        </div>

        <!-- Creation text editor. -->
        <div id="text-editor-create" class="ui modal">
            <div class="header">
                Add a new news article
            </div>
            <div class="content">
                <div class="description">
                    <form id="editor-form-create" class="ui form">

                        <!-- Title. -->
                        <div class="required field">
                            <label>Title</label>
                            <input name="title" type="text" placeholder="Some interesting title...">
                        </div>

                        <!-- Body. -->
                        <div class="field">
                            <label>Body</label>
                            <div id="editor-create"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Close
                </div>
                <div class="ui positive right labeled icon button">
                    Create
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>

        <!-- Edition text editor. -->
        <div id="text-editor-edit" class="ui modal">
            <div class="header">
                Edit news article
            </div>
            <div class="content">
                <div class="description">
                    <form id="editor-form-edit" class="ui form">

                        <!-- Title. -->
                        <div class="required field">
                            <label>Title</label>
                            <input name="title" type="text" placeholder="Some interesting title...">
                        </div>

                        <!-- Body. -->
                        <div class="field">
                            <label>Body</label>
                            <div id="editor-edit"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Close
                </div>
                <div class="ui positive right labeled icon button">
                    Edit
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>

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
                            <div id="news-list" class="ui <?php echo $inverted; ?> relaxed divided selection list">
                                <?php 
                                    $articles = $news->read_all();

                                    if($articles->rowCount() > 0) {
                                        while($article = $articles->fetch(PDO::FETCH_ASSOC)) {
                                            extract($article);
                                            
                                            echo '
                                                <label class="item" data-id="' . $id . '">
                                                    <div class="right floated content">
                                                        <div class="ui button ' . $inverted . ' edit-btn">
                                                            <i class="large middle aligned edit icon"></i>
                                                            Edit
                                                        </div>
                                                    </div>
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
                                <div id="add-btn" class="item">
                                    <div class="content">
                                        <div class="header">
                                            <i class="plus circle icon"></i>
                                            Add a new news article
                                        </div>
                                    </div>
                                </div>
                                <div id="select-btn" class="item">
                                    <div class="content">
                                        <div class="header">
                                            <i class="check circle icon"></i>
                                            Select all news articles
                                        </div>
                                    </div>
                                </div>
                                <div id="unselect-btn" class="item">
                                    <div class="content">
                                        <div class="header">
                                            <i class="circle outline icon"></i>
                                            Unselect all news articles
                                        </div>
                                    </div>
                                </div>
                                <div id="delete-btn" class="item">
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
        
        <!-- The footer. -->
        <footer class="ui basic segment">
            
            <!-- Trademark -->
            <?php require_once "./partials/_trademark.php"; ?>
        </footer>

        <!-- JQuery. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Semantic UI. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

        <!-- Quill. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.min.js"></script>

        <!-- The main script -->
        <script src="<?php echo $config['root']; ?>/assets/js/dashboard/dashboard.js"></script>
    </body>
</html>