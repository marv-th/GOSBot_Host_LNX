<?php 


//* Files

$cron_files = array("cron_gos");
// END

foreach ($cron_files as $key => $value) {
    echo "link cronfile: $value \n";
    if (file_exists("/opt/gosbot/cron/$value")) {
        shell_exec("cd /opt/gosbot/cron && crontab $value");
    } else {
        echo "Die Cron Datei ist nicht vorhanden\n";
    }
}

shell_exec("service cron stop");
shell_exec("service cron start");

echo "Crons created\n";