<?php 
    include("/opt/gosbot/m3i/getid3/getid3.php");

$get_dataname = $_SERVER['argv'][1];
$get_ytid = $_SERVER['argv'][2];

//$get_ytid = $_GET["ytid"];
//$get_dataname = $_GET["dname"];

ini_set("display_errors",1);


if (!file_exists('/opt/gosbot/m3i/getid3/getid3.php')) {
    echo 101;
    exit;
}



$getyturl = 'https://www.youtube.com/watch?v='.$get_ytid.'';


$cmd = 'cd /opt/gosbot/media && LC_ALL=en_US.UTF-8 youtube-dl -o "'.$get_dataname.'" -f bestaudio --extract-audio --audio-format mp3 --audio-quality 0 '.$getyturl.'';
exec($cmd);

$filename = "/opt/gosbot/media/$get_dataname";

if (file_exists($filename)) {
    $getID3 = new getID3;
    $file = $getID3->analyze($filename);
    $playtime_seconds = $file['playtime_seconds'];
    $filesize = $file['filesize'];
    $filesize_conv = round($filesize/1024);

    //$get_config_token = trim(file_get_contents("/opt/gosbot/config/token.config"));
    
    $config_json = "/opt/gosbot/config/config.json";
    if (!file_exists($config_json)) {
        exit(104);
    }
    $json_conf = json_decode(file_get_contents($config_json), true);
    $get_config_token = $json_conf["token"];
    if ($get_config_token==null) {
        exit(105);
    }


    $song_update_tag_url = 'https://gosbot.de/api?server_token='.$get_config_token.'&method=song.update.tag&value_dataname='.$get_dataname.'&value_playtime_seconds='.$playtime_seconds.'&value_filesize_conv='.$filesize_conv.'';
    
    $opts = array('http'=>array('follow_location' => "1"));
    $context = stream_context_create($opts);
    
    $song_update_tag_req = file_get_contents('https://gosbot.de/api?server_token='.$get_config_token.'&method=song.update.tag&value_dataname='.$get_dataname.'&value_playtime_seconds='.$playtime_seconds.'&value_filesize_conv='.$filesize_conv.'', false, $context);


    if ($song_update_tag_req==NULL) {
        echo 103;
    } else {
        echo 1;
    }
} else {
    echo 102;
}
exit;


/*

*/

