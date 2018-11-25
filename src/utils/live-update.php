<?php
    require_once "../config/config.php";
    require_once "../utils/SampQueryAPI.php";

    $config = unserialize(CONFIG);
    $query = new SampQueryAPI($config['server']['ip'], $config['server']['port']);

    if ($query->isOnline()) {
        $data = array(
            "info"      => $query->getInfo(),
            "rules"     => $query->getRules(),
            "players"   => $query->getDetailedPlayers()
        );
    } else {
        $data = json_encode(array("error" => "The server is currently offline"));
    }

    echo json_encode($data);