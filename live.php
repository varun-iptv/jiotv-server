<?php
require ('token.php');
require ('channels.php');

$channel_target = getChannelTarget($_REQUEST['id']);

session_start();

header('Content-Type: application/vnd.apple.mpegurl');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Expose-Headers: Content-Length,Content-Range');
header('Access-Control-Allow-Headers: Range');
header('Accept-Ranges: bytes');

$_SESSION['p'] = $token;

if ($token != "" && @$channel_target != "")
{
$opts = ['http' => ['method' => 'GET', 'header' => 'User-Agent: plaYtv/6.0.9 (Linux; Android 5.1.1) ExoPlayerLib/2.13.2']];
$cx = stream_context_create($opts);

$hs = file_get_contents("https://jiotv.live.cdn.jio.com/" . $channel_target . "/" . $channel_target . "_" . $_REQUEST["q"] . ".m3u8" . $token, false, $cx);
$hs = @preg_replace("/" . $channel_target . "_" . $_REQUEST["q"] . "-([^.]+\.)key/", 'stream.php?key=' . $channel_target . '/' . $channel_target . '_' . $_REQUEST["q"] . '-\1key', $hs);
$hs = @preg_replace("/" . $channel_target . "_" . $_REQUEST["q"] . "-([^.]+\.)ts/", 'stream.php?ts=' . $channel_target . '/' . $channel_target . '_' . $_REQUEST["q"] . '-\1ts', $hs);
$hs = str_replace("https://tv.media.jio.com/streams_live/" . $channel_target . "/", "", $hs);
$hs = str_replace("https://tv.media.jio.com/streams_hotstar/" . $channel_target . "/", "", $hs);

print $hs;
}
?>
