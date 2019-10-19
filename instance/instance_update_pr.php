<?php 


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

$update_pr = file_get_contents('https://gosbot.de/api/unix_token_check?token='.$get_config_token.'&method=synch.instance.update.get.installing&plrq=1', false);
echo $update_pr;