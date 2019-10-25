<?php
    //Aktuelle GOSBot Host Version wird zum GOSBot Server gesendet.
    //Datei wird benötigt, um Update System zu ermöglichen.

    $config_json_path = "/opt/gosbot/config/config.json";
    if (!file_exists($config_json_path)) {
        exit("Error: could not find config.json file");
    } else {
        $config_json = json_decode(file_get_contents($config_json_path), true);
        $send_version = $config_json["version"];
        $get_token = $config_json["token"];
        if ($get_token==null or $send_version==null) {
            exit("Error: Anfrage kann nicht gestartet werden, da Werte fehlen.");
        } else {
            $fgc_send_version = file_get_contents("https://gosbot.de/api/unix_token_check.php?token=$get_token&method=information.set&gosbot_version=$send_version", true);
            echo $fgc_send_version;
        }
    }
?>