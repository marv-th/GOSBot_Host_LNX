<?php 

$get_botid = $_SERVER['argv'][1];
$get_mode = $_SERVER['argv'][2];

ini_set("display_errors",1);

$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("CONFIG wasnt found");
}
$json_conf = json_decode(file_get_contents($config_json), true);
$get_config_token = $json_conf["token"];
if ($get_config_token==null) {
    exit("CONFIG TOKEN IS NOT SET");
}

$fg_url = 'https://gosbot.de/api?server_token='.$get_config_token.'&method=synch.bot.set.power&botID='.$get_botid.'&value='.$get_mode.'';
$song_next = file_get_contents($fg_url, false);
echo $song_next;