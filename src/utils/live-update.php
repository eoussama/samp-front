<?php
    /**
     * Only disable errors if you're pushing this
     * into a production environment.
     * In order to disable it, change `E_ALL` to `0`.
     */
    error_reporting(0);

    require_once "../config/config.php";
    require_once "../utils/SampQueryAPI.php";
    
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
        $config = unserialize(CONFIG);
        $query = new SampQueryAPI($config['server']['ip'], $config['server']['port']);
    
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
        $data = array("error" => htmlspecialchars($e->getMessage()));
    }
    finally {
        echo json_encode($data);
    }
