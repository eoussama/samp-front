<?php
    require_once "../../config/Database.php";
    require_once "../../models/News.php";

    try {
        if (isset($_POST['ids'])) {
            $ids    = $_POST['ids'];
            $db     = new Database();
            $conn   = $db->connect();
            $news   = new News($conn);

            if (is_array($ids)) {
                $deleted = 0;

                for ($i = 0; $i<count($ids); $i++) {
                    if ($news->delete(htmlspecialchars(strip_tags($ids[$i])))) {
                        $deleted++;
                    }
                }

                $data = array("deleted"   => $deleted);
            } else {
                throw new Exception("Invalid data format.");
            }
        } else {
            throw new Exception("No ids recieved.");
        }
    }
    catch(Exception $e) {
        $data = array("error" => htmlspecialchars(strip_tags( $e->getMessage())));
    }
    finally {
        echo json_encode($data);
    }