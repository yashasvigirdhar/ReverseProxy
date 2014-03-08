<html>
<body>
<?php $user = $_POST["user"];
$pass = $_POST["pass"];

$fields = array(
'StUdent' => urlencode($user),
'password' => urlencode($pass),
'searchin' => urlencode("200")
);
$fields_string='';
//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');


$cookie_file = "/var/www/cookie.txt";
$ch = curl_init();
$url="https://isas.iiit.ac.in/validate.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
if(!curl_exec($ch)){
	    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}


$url2="https://isas.iiit.ac.in/academicProfile.php";
curl_setopt($ch, CURLOPT_URL, $url2);
curl_setopt($ch,CURLOPT_POST, NULL);
curl_setopt($ch,CURLOPT_POSTFIELDS, NULL);
if(!curl_exec($ch)){
	    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}

curl_close($ch);
?>


</body>
</html>
