<?php 

$get_conf_key = $_SERVER['argv'][1];
if ($get_conf_key==null) {
    exit("error: there is no key given\n");
}
$get_conf_value = $_SERVER['argv'][2];
if ($get_conf_value==null) {
    exit("error: there is no value given\n");
}

$conf_json = "/opt/gosbot/config/config.json";

$conf = json_decode(file_get_contents($conf_json), true);

if ($conf["mode"]==null) {
    $inhalt_arr = array(
        "mode" => "stable",
        "version" => "1.0",
        "token" => null,
        "default_bot" => array(
            "badges" => null,
            "bitrate" => 96,
            "volume" => 30
        ),
        "start" => false,
        "sbin" => true
    );
    $inhalt = json_encode($inhalt_arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents($conf_json, $inhalt);
    if (!file_exists($conf_json)) {
        exit("error: failed to create config file\n");
    }
}

$conf = json_decode(file_get_contents($conf_json), true);
$conf["$get_conf_key"] = $get_conf_value;
file_put_contents($conf_json, json_encode($conf, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
