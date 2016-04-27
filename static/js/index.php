<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//


extract($_REQUEST);

if(!isset($token)){
	echo('{"status":"fail", "msg":"please send token"}');
	return;
}

if(!isset($channel)){
	echo('{"status":"fail", "msg":"please send channel"}');
	return;
}

if(!isset($data)){
	$data = array();
	
}
else{
	$data = json_decode($data, true);
}

if(!isset($action)){
	$action = "create";
}


switch($action){

	case "create":
		$resp = createChannel($token, $channel, $data);
	break;

	default:
		$resp = createChannel($token, $channel, $data);
	break;
}





echo($resp);


function createChannel($name, $image, $data){



$ch = curl_init( 'https://api.sendbird.com/channel/create' );
# Setup request to send json via POST.
$payload = json_encode( array("name"=>$name, "image"=>$image, "data"=>$data));
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
# Print response.
return "<pre>$result</pre>";

}


?>