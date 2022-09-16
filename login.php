<?php

$username = "+91" . $_GET['user'];
$password = $_GET['pass'];

$randroid = bin2hex(random_bytes(8));

$payload = array(
'identifier' => "$username",
'password' => "$password",
'rememberUser' => 'T',
'upgradeAuth' => 'Y',
'returnSessionDetails' => 'T',
'deviceInfo' => array(
'consumptionDeviceName' => 'samsung SM-G930F',
'info' => array(
'type' => 'android',
'platform' => array(
'name' => 'SM-G930F',
'version' => '5.1.1'
),
'androidId' => "$randroid"
)
)
);

$ch = curl_init();

curl_setopt_array($ch, array(CURLOPT_URL => 'https://api.jio.com/v3/dip/user/unpw/verify',
CURLOPT_POSTFIELDS => json_encode($payload),
CURLOPT_USERAGENT => 'Dalvik/2.1.0 (Linux; U; Android 5.1.1; SM-G930F Build/LMY48Z)',
CURLOPT_HTTPHEADER => array(
'Content-Type: application/json',
'x-api-key: l7xx938b6684ee9e4bbe8831a9a682b8e19f',
'app-name: RJIL_JioTV'
),
CURLOPT_AUTOREFERER => true,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_FOLLOWLOCATION => 1,
CURLOPT_ENCODING => 'UTF-8',
CURLOPT_TIMEOUT => 20
)
);

$result = curl_exec($ch);
curl_close($ch);

$j = json_decode($result, true);

$k = $j['ssoToken'];
if ($k != '')
{
file_put_contents('creds.json', $result);
echo 'Logged in successfully!';
}
?>
