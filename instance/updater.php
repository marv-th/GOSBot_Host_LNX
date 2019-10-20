<?php
/*
echo "GOSBot Updater.\n";

if (file_exists("/opt/no_gosbot_update")) {
    exit("ERROR: UPDATE WAS BLOCKED");
}

$updater_json = "/opt/gosbot/config/config.json";
if (!file_exists($updater_json)) {
    exit("error: there is no config.json file.\n");
}
$updater_conf = json_decode(file_get_contents($updater_json), true);

$conf_version = $updater_conf["version"];

$ytdl_update = "sudo pip install --upgrade youtube-dl ";


echo "Update Youtube dl\n";
$ytdl_update_shell = shell_exec($ytdl_update);
if ($ytdl_update==null) {
    echo "error on running shell command.";
} else {
    echo 'Result: '.$ytdl_update;
}
echo "it seems, that youtube dl is up to date.\n";
sleep(2);
echo "We will update all the others packages too\n";

//$update_packages = array("sudo","libopus-dev", "ffmpeg", "python-pip", "youtube-dl", "tmux", "apt-transport-https", "dotnet-sdk-2.2", "php", "php-json", "cron", "zip", "unzip");
$update_packages = array("sudo","libopus-dev", "ffmpeg", "python-pip", "youtube-dl", "tmux", "php", "php-json", "cron", "zip", "unzip");
echo shell_exec("apt-get update");

foreach ($update_packages as $key => $value) {
    echo "Update Package \"$value\" \n";
    echo shell_exec("apt-get install $value --yes"); 
    echo "Package \"$value\" is now up to date.\n";
}

$check_update_url = "http://build.gosbot.de/releases/gosbot_client/linux/current.json";
$check_update = json_decode(file_get_contents($check_update_url),true);
$check_update_version = $check_update["version"];
$check_update_download = $check_update["download"];
$check_update_text_installed = $check_update["text_installed"];
$check_update_run_scripts_installed = $check_update["run_scripts_installed"];
$check_update_text_install = $check_update["text_install"];
$check_update_run_scripts_install = $check_update["run_scripts_install"];
$check_update_filename = $check_update["filename"];

if ($check_update==null) {
    echo "\nERROR: No Result from GOSBot Server. Please try again later. \n";
} else {
    if (version_compare($conf_version, $check_update_version, "<")) {
        echo "Deine GOSBot Host Version ist veraltet.\n";
        sleep(1);
        echo "Aber kein Problem!\nWir werden diesen schnell aktualisieren, damit du deinen GOSBot wieder problemlos, voll und mit neuen Features nutzen kannst.\n";
        echo $check_update_text_install;
        foreach ($check_update_run_scripts_install as $key => $value) {
            echo shell_exec($value);
        }
        echo "Vorbereitung abgeschlossen\n";
        echo shell_exec("cd /opt/ && mkdir gosbot_update && chmod 777 -R gosbot_update && cd gosbot_update && wget $check_update_download && unzip $check_update_filename && cp -r * /opt/gosbot");
        echo "Haupt Prozess abgeschlossen\n";
        foreach ($check_update_run_scripts_installed as $key => $value) {
            echo shell_exec($value);
        }
    
        if ($updater_conf["start"]) {
            echo shell_exec("cd /opt/gosbot/instance && php instance_start.php");
        }
    
        echo $check_update_text_installed;
        echo "Update erfolgreich installiert.\n";
    } else {
        echo "Dein GOSBot Host ist auf dem neusten Stand und benötigt keine Aktualisierung.\n";
    }
}





//work on for continiue.




