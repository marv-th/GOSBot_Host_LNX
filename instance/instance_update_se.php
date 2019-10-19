<?php 
ini_set("display_errors",0);
function wait_points($times) {
    $a = 0;
    while ($a <= $times) {
        $a++;
        usleep(500000);
        echo ".";
    }
}

function console_print($text, $type = null) {
    if ($type=="error") {
        echo "\033[01;31m $text \033[0m \n";
        exit();
    } elseif ($type=="success") {
        echo "\033[01;32m $text \033[0m \n";
    } elseif ($type=="process") {
        echo "\033[01;33m $text \033[0m \n";
    } else {
        echo "\033[01;34m $text \033[0m \n";
    }
}
$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("CONFIG wasnt found");
}
$json_conf = json_decode(file_get_contents($config_json), true);
if (!array_key_exists("token",$json_conf)) {
    exit("ERROR: You have no token setup in your config.json. Please contact us.");
}
$get_config_token = $json_conf["token"];
$update_url = 'https://gosbot.de/api/unix_token_check?token='.$get_config_token.'&method=synch.instance.update.get.installing&plrq=1';
$update_pr = file_get_contents($update_url, false);
if (file_exists("/opt/no_gosbot_update")) {
    exit("error: Update was blocked. Delete /opt/no_gosbot_update to install updates");
}
$updater_json = "/opt/gosbot/config/config.json";
if (!file_exists($updater_json)) {
    exit("error: there is no config.json file.\n");
}
$updater_conf = json_decode(file_get_contents($updater_json), true);

$check_update = json_decode($update_pr, true);

if (!array_key_exists("version",$check_update)) {
    if (array_key_exists("error",$check_update)) {
        console_print($check_update["error"], "error");
    }
    exit("Error: Failed to load Update Informations\n");
} else {

    $check_update_build = $check_update["build"];
    $check_update_platform = $check_update["platform"];
    $check_update_version = $check_update["version"];
    $check_update_sha = $check_update["sha"];
    $check_update_download = $check_update["download"];
    $check_update_text_installed = $check_update["text_installed"];
    $check_update_run_scripts_installed = $check_update["run_scripts_installed"];
    $check_update_text_install = $check_update["text_install"];
    $check_update_run_scripts_install = $check_update["run_scripts_install"];
    $check_update_filename = $check_update["filename"];

    console_print("Update wird gestartet", "success");
    echo "Please wait";
    echo wait_points(4)."\n";
    console_print($check_update_text_install);
    console_print("Vorbereitung wird gestartet", "process");
    foreach ($check_update_run_scripts_install as $key => $value) {
        echo shell_exec($value);
    }
    console_print("Vorbereitung abgeschlossen", "success");
    console_print("Updateordner wird erstellt", "process");
    if (!mkdir("/opt/gosbot_update/", 0777, true)) {
        console_print("Erstellung des Update Ordners schlug fehl. path: /opt/gosbot_update", "error");
        exit();
    } else {
        console_print("Updateordner wurde erstellt", "success");
    }
    console_print("Packete werden heruntergeladen", "process");
    shell_exec("cd /opt/gosbot_update && wget -q $check_update_download");
    if (file_exists("/opt/gosbot_update/$check_update_filename")) {
        console_print("Packete wurden heruntergeladen", "success");
    } else {
        console_print("Herunterladen der Packete fehlgeschlagen. file: $check_update_filename", "error");
        exit();
    }
    console_print("Packete werden entpackt", "process");
    shell_exec("cd /opt/gosbot_update && unzip $check_update_filename && cp -r * /opt/gosbot");
    console_print("Packete wurden entpackt", "success");
    foreach ($check_update_run_scripts_installed as $key => $value) {
        echo shell_exec($value);
    }
    echo shell_exec("cd /opt/gosbot/instance/ && php configer.php \"token\" \"$get_config_token\"");
    echo shell_exec("cd /opt/gosbot/instance/ && php configer.php \"version\" \"$check_update_version\"");
    echo shell_exec("cd /opt/gosbot/instance/ && php configer.php \"build\" \"$check_update_build\"");
    echo shell_exec("cd /opt/gosbot/instance/ && php configer.php \"platform\" \"$check_update_platform\"");
    $runtime_conf = json_decode(file_get_contents("/opt/gosbot/instance/bot/TS3AudioBot.runtimeconfig.json"), true);
    $runtime_conf["runtimeOptions"]["framework"]["version"] = "3.0.0";
    $inh_rt_cnf_js = json_encode($runtime_conf,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    if (!file_put_contents("/opt/gosbot/instance/bot/TS3AudioBot.runtimeconfig.json",$inh_rt_cnf_js)) {
        echo "Macht er ned";
    }
    if ($updater_conf["start"]) {
        echo shell_exec("cd /opt/gosbot/instance && php instance_start.php");
        console_print("Instance wurde gestartet", "success");
    }

    echo $check_update_text_installed."\n";
    console_print("Instalation wurde abgeschlossen", "success");
}

