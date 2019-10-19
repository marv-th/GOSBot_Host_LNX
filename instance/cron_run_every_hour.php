<?php 
<<<<<<< HEAD
/*
=======

>>>>>>> 178d34b8bdcb2d141e2381322d10046952706f76
$config_json = "/opt/gosbot/config/config.json";
if (!file_exists($config_json)) {
    exit("Error: could not find config.json file");
}
$conf = json_decode(file_get_contents($config_json), true);
echo "Start Update cron\n\n";
<<<<<<< HEAD
echo shell_exec("cd /opt/gosbot/instance && php updater.php");
=======
echo shell_exec("cd /opt/gosbot/instance && php updater.php");
echo shell_exec("cd /opt/gosbot/instance && php send_version.php");
>>>>>>> 178d34b8bdcb2d141e2381322d10046952706f76
