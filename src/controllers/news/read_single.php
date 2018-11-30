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

    $id     = htmlspecialchars(strip_tags($_GET['id']));
    $db     = new Database();
    $conn   = $db->connect();
    $news   = new News($conn);

    $news->read_single($id);
    $news->body = htmlspecialchars_decode($news->body);

    echo json_encode($news);