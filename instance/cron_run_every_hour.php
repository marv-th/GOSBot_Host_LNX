<?php 
/*
$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Error: could not find config.json file");
}
$conf = json_decode(file_get_contents($config_json), true);
echo "Start Update cron\n\n";
echo shell_exec("cd /opt/gosbot/instance && php updater.php");