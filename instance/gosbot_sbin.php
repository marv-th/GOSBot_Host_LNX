<?php 

echo "GOSBot Client \n";
echo "More information: https://gosbot.de\n";
echo "\n";


$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Error: could not find config.json file");
}
$conf = json_decode(file_get_contents($config_json), true);
if ($conf["sbin"]!==true) {
    exit("Error: This feature was disabled in config.json. Set sbin to true");
}

echo "\n";

$statement_1 = $_SERVER['argv'][1];

if ($statement_1=="start") {
    include("/opt/gosbot/instance/instance_start.php");
}
elseif ($statement_1=="stop") {
    include("/opt/gosbot/instance/instance_stop.php");
}
elseif ($statement_1=="update") {
    include("/opt/gosbot/instance/updater.php");
}
elseif ($statement_1=="help") {
    statement_help();
} 
elseif ($statement_1=="status") {
    if ($conf["start"]===true) {
        echo "GOSBot Client sollte aktiv sein.\n";
    } else {
        echo "GOSBot Client sollte deaktiviert sein.\n";
    }
}
elseif ($statement_1==null) {
    echo("Du hast keinen Parameter angegeben.\nGebe einen Parameter an, um diese Funktion zu nutzen.\n");
    statement_help();
}
else {
    echo("Dies ist ein ungültiger Parameter.\n");
    statement_help();
}



function statement_help() {
    $statements = array(
        "start"         => "Start your GOSBot Client",
        "stop"          => "Stop your GOSBot Client",
        "status"        => "Current Bot Status. Prints out, if the bot is running or not",
        "help"          => "Informations about all statements",
        "update"        => "Update your GOSBot Client"
    );
    
    echo "Alle Befehle im Überblick:\n";
    ksort($statements);
    foreach ($statements as $key => $value) {
        if ($value==null) {
            $value = "Keine Beschreibung vorhanden";
        }
        echo "-> gosbot $key  -  $value \n";
    }
}