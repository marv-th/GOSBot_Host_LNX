<?php 
/* Deaktiviert// TODO
$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Error: could not find config.json file");
}
$conf = json_decode(file_get_contents($config_json), true);
if ($conf["start"]) {
    echo shell_exec("cd /opt/gosbot/instance && php instance_start.php");
} else {
    echo "Could not start, cause the bot is not running anymore.\n";
}
*/