<?php
    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     */

    require_once "../../config/Database.php";
    require_once "../../models/News.php";

    try {
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['body'])) {
            $id  = htmlspecialchars(strip_tags($_POST['id']));
            $title  = htmlspecialchars(strip_tags($_POST['title']));
            $body   = htmlspecialchars($_POST['body']);

            $db     = new Database();
            $conn   = $db->connect();
            $news   = new News($conn);

            if (!$news->update($id, $title, $body)) {
                throw new Exception("News article was not updated.");
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