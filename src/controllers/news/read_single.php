<?php
    require_once "../../config/Database.php";
    require_once "../../models/News.php";

    $id     = htmlspecialchars(strip_tags($_GET['id']));
    $db     = new Database();
    $conn   = $db->connect();
    $news   = new News($conn);

    $news->read_single($id);

    echo json_encode($news);