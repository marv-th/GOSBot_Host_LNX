<?php 
ini_set("display_errors",0);
echo 1;
shell_exec('cd /opt/gosbot/instance/bot && tmux new -d -s "gosbot_host_update" php instance_update_se.php >/dev/null 2>&1');