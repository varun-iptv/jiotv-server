<?php
require ('req_protocol.php');

$host = $_SERVER['HTTP_HOST'];
$dir = dirname($_SERVER['SCRIPT_NAME']);
$id = $_GET['id'];

header('Content-Type: application/vnd.apple.mpegurl');

echo <<<CONTENT
#EXTM3U
#EXT-X-VERSION:3
#EXT-X-STREAM-INF:PROGRAM-ID=1,CLOSED-CAPTIONS=NONE,BANDWIDTH=250000,RESOLUTION=426x240
$protocol://$host$dir/live.php?id=$id&q=250
#EXT-X-STREAM-INF:PROGRAM-ID=1,CLOSED-CAPTIONS=NONE,BANDWIDTH=400000,RESOLUTION=854x480
$protocol://$host$dir/live.php?id=$id&q=400
#EXT-X-STREAM-INF:PROGRAM-ID=1,CLOSED-CAPTIONS=NONE,BANDWIDTH=600000,RESOLUTION=1024x576
$protocol://$host$dir/live.php?id=$id&q=600
#EXT-X-STREAM-INF:PROGRAM-ID=1,CLOSED-CAPTIONS=NONE,BANDWIDTH=800000,RESOLUTION=1280x720
$protocol://$host$dir/live.php?id=$id&q=800
#EXT-X-STREAM-INF:PROGRAM-ID=1,CLOSED-CAPTIONS=NONE,BANDWIDTH=1200000,RESOLUTION=1920x1080
$protocol://$host$dir/live.php?id=$id&q=1200
CONTENT;

?>
