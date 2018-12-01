<?php
    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     * 
     * The script that deletes the news articles.
     */

    // Requiring the configurations.
    require_once "./../../config/config.php";
    // Loading the website's configurations.
    $config = unserialize(CONFIG);

    // Requiring all dependencies.
    require_once pathfy('models', 'root') . "Database.php";
    require_once pathfy('models', 'root') . "News.php";

    try {
        if (isset($_POST['ids'])) {
            // Getting the ids.
            $ids    = $_POST['ids'];

            $db = new Database(
                $config['database']['host'],
                $config['database']['name'],
                $config['database']['user'],
                $config['database']['pass']
            );
            $conn = $db->connect();
            $news = new News($conn);

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