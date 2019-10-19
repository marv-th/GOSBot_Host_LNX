<?php 


$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Error: could not find config.json file");
}
$conf = json_decode(file_get_contents($config_json), true);
$conf["start"] = false;
file_put_contents($config_json, json_encode($conf, JSON_PRETTY_PRINT));

$get_config_token = $conf["token"];
$instance_power_url = 'https://gosbot.de/api/unix_token_check?token='.$get_config_token.'&method=instance.power.set.off&plrq=1';
$instance_power = file_get_contents($instance_power_url, false);

shell_exec(`cd /opt/gosbot/instance/bot && tmux send-keys -t "gosbot_client" '^C' C-m  >/dev/null 2>&1 && sleep 3 && tmux send-keys -t "gosbot_client" '^C' C-m  >/dev/null 2>&1 && sleep 1 && tmux kill-session -t "gosbot_client"  >/dev/null 2>&1`);
echo "\nGOSBot Client wurde gestoppt.\n";