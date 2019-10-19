<?php 
error_reporting(~0);

ini_set("display_errors",1);

print ini_get('allow_url_open');

$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Config Datei konnte nicht gefunden werden\n");
}
$json_conf = json_decode(file_get_contents($config_json), true);
$get_config_token = $json_conf["token"];
if ($get_config_token==null) {
    exit("Config Token wurde nicht gespeichert\n");
}
$url_bl = 'https://gosbot.de/';
    

$url = "https://gosbot.de/api/?server_token=$get_config_token&method=array.bots.list";
$jsonData = json_decode(file_get_contents($url), true);
foreach ($jsonData as $key => $value) {

    if ($value["power"]==1 OR $value["power"]==2) {
        $run_power = "true";
    } else {
        $run_power = "false";
    }

    if ($value["defaultchannel"]==null) {
        $value["defaultchannel"] = 0;
    }

    $bot_adress = $value["ip"].':'.$value["tsport"];


$new_tml_bot = '#Starts the instance when the TS3AudioBot is launched.
run = '.$run_power.'

[commands]

[commands.alias]

[connect]
address = "'.$bot_adress.'"
channel = "/'.$value["defaultchannel"].'"
badges = ""
name = "'.$value["BotName"].'"
client_version = {  }

[connect.identity]
key = "'.$value["ts_identity"].'"
offset = "'.$value["ts_identity_offset"].'"

[connect.channel_password]
pw = ""
hashed = false
autohash = false

[connect.server_password]
pw = ""
hashed = false
autohash = false

[audio]
bitrate = 96
send_mode = "voice"
volume = { default = '.$value["defaultvolume"].'.0, min = 0.0, max = 100.0 }

[reconnect]

[playlists]

[history]

[events]
#Called when the bot is connected.
onconnect = "!xecute (!bot commander on)"
#Called when the bot does not play anything for a certain amount of time.
onidle = ""
';

    mkdir("/opt/gosbot/bots/".$value["BotID"], 0755);

    file_put_contents("/opt/gosbot/bots/".$value["BotID"]."/bot.toml", $new_tml_bot);
}

exit("Deine vorherigen Bots wurden wiederhergestellt\n");