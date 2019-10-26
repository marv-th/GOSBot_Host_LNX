<?php 
ini_set("display_errors",0);
//shell_exec("cd /opt/gosbot/instance/ && php -f instance_update_se.php >/dev/null &2>/dev/null &");

shell_exec('cd /opt/gosbot/instance/bot && tmux new -d -s "gosbot_host_update" php instance_update_se.php >/dev/null 2>&1');

