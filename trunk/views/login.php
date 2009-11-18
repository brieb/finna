<body onload="initFB();">


<?php

$api_key = '9500bfadfe4325d9173168b33ee7d602';
$secret = '0abc350209832d1066dcc68bf7052b62';

include_once 'facebook-client/facebook.php';


$auth_token = $_REQUEST['auth_token'];
$facebook = new Facebook($api_key, $secret);
$uid = $facebook->get_loggedin_user();
$session_key = $facebook->api_client->auth_getSession($auth_token);

$friends = $facebook->api_client->friends_get();
var_dump($friends);

/* Stores uid in db
connect_to_db();
$query="INSERT INTO users (fbid) VALUES('$uid')";
$result=mysql_query($query) or die(mysql_error());
*/
?>

</HTML>