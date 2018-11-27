<?php
    require_once "../config/config.php";
    require_once "../utils/SampQueryAPI.php";
    
    /**
     * Sanitizes the server's rules and information.
     */
    function sanitizeInfo ($info) {
        foreach ($info as $key => $value) {
            $info[$key] = htmlspecialchars($value);
        }

        return $info;
    }

    /**
     * Sanitizes the players' information.
     */
    function sanitizePlayers ($players) {
        foreach ($players as $player) {
            foreach ($player as $key => $value) {
                $info[$key] = htmlspecialchars($value);
            }
        }

        return $players;
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
        $data = json_encode(array("error" => htmlspecialchars($e->getMessage())));
    }
    finally {
        echo json_encode($data);
    }
