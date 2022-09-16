<?php
header("Content-Type: application/vnd.apple.mpegurl");

require ('channels.php');
require ('req_protocol.php');

$channels = getChannelList();

$host = $_SERVER['HTTP_HOST'];
$dir = dirname($_SERVER['SCRIPT_NAME']);
$id = $_GET['id'];

echo <<<HEADER
#EXTM3U x-tvg-url="https://raw.githubusercontent.com/mitthu786/tvepg/main/jiotv/epg.xml.gz"

HEADER;

foreach ($channels as $channel)
{
$id = $channel['channel_id'];
$genre = $GENRE_MAP[$channel['channelCategoryId']];
$language = $LANG_MAP[$channel['channelLanguageId']];
$logo = $channel['logoUrl'];
$name = $channel['channel_name'];

echo <<<CONTENT
#EXTINF:-1 tvg-id="varunJiotv$id" group-title="$genre" tvg-language="$language" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/$logo", $name
$protocol://$host$dir/autoq.php?id=$id


CONTENT;
}
?>
