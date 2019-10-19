<?php 

$get_dataname = basename($_SERVER['argv'][1]);


if (!file_exists('/opt/gosbot/media/'.$get_dataname)) {
    echo 101;
    exit;
} else {
    unlink('/opt/gosbot/media/'.$get_dataname);
    if (file_exists('/opt/gosbot/media/'.$get_dataname)) {
        echo 102;
    } else {
        echo 1;
    }
}


