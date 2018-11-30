<?php
    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     */

    require_once "./../../config/Database.php";
    require_once "./../../models/News.php";

    try {
        if (isset($_POST['title']) && isset($_POST['body'])) {
            $title  = htmlspecialchars(strip_tags($_POST['title']));
            $body   = htmlspecialchars($_POST['body']);

            $db     = new Database();
            $conn   = $db->connect();
            $news   = new News($conn);

            if (!$news->create($title, $body)) {
                throw new Exception("News article was not created.");
            }
        } else {
            throw new Exception("Insufficient data recieved.");
        }
    }
    catch(Exception $e) {
        $data = array("error" => htmlspecialchars(strip_tags( $e->getMessage())));
    }
    finally {
        echo json_encode($data);
    }