<?php 

$get_botid = $_SERVER['argv'][1];

<<<<<<< HEAD
echo "botid: $get_botid";
=======
>>>>>>> 178d34b8bdcb2d141e2381322d10046952706f76
ini_set("display_errors",0);

$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("CONFIG wasnt found");
}
$json_conf = json_decode(file_get_contents($config_json), true);
$get_config_token = $json_conf["token"];
if ($get_config_token==null) {
    exit("CONFIG TOKEN IS NOT SET");
}
<<<<<<< HEAD
$url = 'https://gosbot.de/api?server_token='.$get_config_token.'&method=synch.bot.next.song&botID='.$get_botid.'';
echo $url;
$song_next = file_get_contents($url, false);
=======

$song_next = file_get_contents('https://gosbot.de/api?server_token='.$get_config_token.'&method=synch.bot.next.song&botID='.$get_botid.'', false, $context);
>>>>>>> 178d34b8bdcb2d141e2381322d10046952706f76
echo $song_next;