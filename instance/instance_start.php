<?php 


$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Error: could not find config.json file");
}
$conf = json_decode(file_get_contents($config_json), true);
$conf["start"] = true;
file_put_contents($config_json, json_encode($conf, JSON_PRETTY_PRINT));


<<<<<<< HEAD
shell_exec('cd /opt/gosbot/instance/bot && tmux new -d -s "gosbot_client" /opt/gosbot/dotnet/./dotnet TS3AudioBot.dll >/dev/null 2>&1');

$get_config_token = $conf["token"];
$instance_power_url = 'https://gosbot.de/api/unix_token_check?token='.$get_config_token.'&method=instance.power.set.on&plrq=1';
$instance_power = file_get_contents($instance_power_url, false);

=======
shell_exec('cd /opt/gosbot/instance/bot && tmux new -d -s "gosbot_client" dotnet TS3AudioBot.dll >/dev/null 2>&1');
>>>>>>> 178d34b8bdcb2d141e2381322d10046952706f76
echo "\nGOSBot Client wurde gestartet\n";