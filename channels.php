<?php
$LANG_MAP = array(
6 => 'English',
1 => 'Hindi',
2 => 'Marathi',
3 => 'Punjabi',
4 => 'Urdu',
5 => 'Bengali',
7 => 'Malayalam',
8 => 'Tamil',
9 => 'Gujarati',
10 => 'Odia',
11 => 'Telugu',
12 => 'Bhojpuri',
13 => 'Kannada',
14 => 'Assamese',
15 => 'Nepali',
16 => 'French'
);

$GENRE_MAP = array(
8 => 'Sports',
5 => 'Entertainment',
6 => 'Movies',
12 => 'News',
13 => 'Music',
7 => 'Kids',
9 => 'Lifestyle',
10 => 'Infotainment',
15 => 'Devotional',
16 => 'Business',
17 => 'Educational',
18 => 'Shopping',
19 => 'JioDarshan'
);

function getChannelList()
{
$cache = 'channels.json';
$force_refresh = false;
$refresh = 60 * 60 * 24;
if ($force_refresh || ((time() - filectime($cache)) > ($refresh) || 0 == filesize($cache)))
{
$channels_data_fetcher = curl_init();
curl_setopt_array($channels_data_fetcher, array(
CURLOPT_URL => 'https://jiotv.data.cdn.jio.com/apis/v1.4/getMobileChannelList/get/?os=android&devicetype=phone',
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_ENCODING => 'gzip, deflate',
CURLOPT_HTTPHEADER => array(
'Accept: application/json'
)
));
$result = curl_exec($channels_data_fetcher) or die('Could not fetch channels list');
$channels_data = json_decode($result, true);
curl_close($channels_data_fetcher);
$handle = fopen($cache, 'wb');
fwrite($handle, json_encode($channels_data['result']));
fclose($handle);
return $channels_data['result'];
}
else
{
return json_decode(file_get_contents($cache) , true);
}
}

function getChannelTarget($id)
{
$channel_target_fetcher = curl_init();
$post_data = array(
'channel_id' => $id
);
curl_setopt_array($channel_target_fetcher, array(
CURLOPT_URL => 'https://tv.media.jio.com/apis/v1.4/getchannelurl/getchannelurl',
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_POST => 1,
CURLOPT_POSTFIELDS => json_encode($post_data) ,
CURLOPT_HTTPHEADER => array(
'Content-Type: application/json'
) ,
));
$result = curl_exec($channel_target_fetcher) or die('Could not fetch channel target');
$channel_target_data = json_decode($result, true);
curl_close($channel_target_fetcher);
$channel_target = $channel_target_data['result'];
$channel_target = @preg_replace(';bpk-tv\/([^.]+)_MOB\/output01\/index.m3u8\?minrate=(?:.*)&maxrate=(?:.*);', '\1', $channel_target);
$channel_target = str_replace("https://jiotv.live.cdn.jio.com/", "", $channel_target);
$channel_target = basename($channel_target, '.m3u8');
return $channel_target;
}
?>
