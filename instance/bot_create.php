<?php 

$get_bot_id = basename($_SERVER['argv'][1]);
$get_adresse = $_SERVER['argv'][2];
$get_name = $_SERVER['argv'][3];
$get_server_password = $_SERVER['argv'][4];


$bots_folder = "/opt/gosbot/bots/";

$bot_folder = $bots_folder . $get_bot_id;
$bot_file = $bot_folder . '/bot.toml';

if (!mkdir($bot_folder, 0777, true)) {
    exit(101);
} else {

    $config_json = "/opt/gosbot/config/config.json";
    if (!file_exists($config_json)) {
        exit(102);
    }
    $conf = json_decode(file_get_contents($config_json), true);
    $get_badges = $conf["default_bot"]["badges"];
    $get_bitrate = $conf["default_bot"]["bitrate"];
    $get_volume = $conf["default_bot"]["volume"];

    if ($get_bitrate==null) {
        $get_bitrate = 96;
    }

    if ($get_volume==null) {
        $get_volume = 30;
    }


$inhalt = '#Generate by GOSBot. Provided by TS3Audiobot
run = false

[connect]
address = "'.$get_adresse.'"
channel = ""
badges = "'.$get_badges.'"
name = "'.$get_name.'"

[connect.identity]

[connect.server_password]
pw = "'.$get_server_password.'"
hashed = false
autohash = false

[audio]
bitrate = '.$get_bitrate.'
send_mode = "voice"
volume = { default = '.$get_volume.'.0, min = 0.0, max = 100.0 }
';


    $handle = fopen ($bot_file, "w");
    fwrite ($handle, $inhalt);
    fclose ($handle);
    if (!file_exists($bot_file)) {
        exit(103);
    } else {
        exit(1);
    }



}