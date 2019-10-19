<?php 


$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Error: could not find config.json file");
}
$conf = json_decode(file_get_contents($config_json), true);
$conf["start"] = true;
file_put_contents($config_json, json_encode($conf, JSON_PRETTY_PRINT));


shell_exec('cd /opt/gosbot/instance/bot && tmux new -d -s "gosbot_client" dotnet TS3AudioBot.dll >/dev/null 2>&1');
echo "\nGOSBot Client wurde gestartet\n";