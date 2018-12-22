<?php

    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     * 
     * This script is responsible on fetching the data of the related
     * SA:MP server and sending it for the website's index page to be
     * processed.
     */

    // Setting the header.
    header('Content-type: application/json');

    /**
     * Only disable errors if you're pushing this
     * into a production environment.
     * In order to disable it, change `E_ALL` to `0`.
     */
    error_reporting(E_ALL);

    // Requiring the configurations.
    require_once "./../config/config.php";

    // Loading the configurations.
    $config = unserialize(CONFIG);

    // Requiring the SampQueryAPI that does all the magic.
    require_once pathfy('lib') . "SampQueryAPI.php";
    
    /**
     * Sanitizes the server's rules and information.
     */
    function sanitizeInfo ($info) {

        if (is_array($info) || is_object($info)) {

            foreach ($info as $key => $value) {

                $info[$key] = htmlspecialchars(strip_tags($value));
            }

            return $info;
        }

        return null;
    }

    /**
     * Sanitizes the players' information.
     */
    function sanitizePlayers ($players) {

        if (is_array($players) || is_object($players)) {

            foreach ($players as $player) {

                if (is_array($player) || is_object($player)) {

                    foreach ($player as $key => $value) {

                        $info[$key] = htmlspecialchars(strip_tags($value));
                    }
                }
            }

            return $players;
        }

        return null;
    }

    try {
        
        $query = new SampQueryAPI($config['samp']['ip'], $config['samp']['port']);
    
        $server_info    = sanitizeInfo($query->getInfo());
        $server_rules   = sanitizeInfo($query->getRules());
        $players        = sanitizePlayers($query->getDetailedPlayers());

        if ($query->isOnline()) {

            $data = array(
                "info"      => $server_info,
                "rules"     => $server_rules,
                "players"   => $players
            );
        } else {

            throw new Exception("The server is currently offline");
        }
    }
    catch(Exception $e) {

        $data = array("error" => htmlspecialchars(strip_tags($e->getMessage())));
    }
    finally {

        echo json_encode($data);
    }
