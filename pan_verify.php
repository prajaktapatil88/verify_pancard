
<?php

if(!empty($_POST)) {	
	$pan_num = $_POST['pan_number'];
	//extract data from the post
//set POST variables
$url = 'http://searchpan.in/pan-verify-26072017.php';
$fields = array(
	'pan_numbers' => $_POST['pan_number'],
	'captchaCode' => "NTJHQ"
);

//url-ify the data for the POST
$field_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $field_string);

//execute post
$result = curl_exec($ch);
echo $result;

//close connection
curl_close($ch);
}
?>