<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

//get clout bucket name
//ensure this is set up, see "Admin Console" note/link here:
//https://cloud.google.com/appengine/docs/php/googlestorage/setup
//nevermind, that doesn't work either, there's no way this works.
//use google\appengine\api\cloud_storage\CloudStorageTools;
//$_GLOBALS['bucket'] = CloudStorageTools::getDefaultGoogleStorageBucketName();
$_GLOBALS['bucket'] = 'sallyandjames';

//set up spreadsheet factory
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

$client_id = '357763257412-lsjsi7dnnjecone11se2te2n3npjirk8.apps.googleusercontent.com';
$client_secret = 'YQ1N7OoUBMuHFqcRI8R8RV45';
$dev_key = '';
$redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].'/admin/index.php';

//from: https://github.com/google/google-api-php-client/blob/master/examples/multi-api.php
/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
//$client->setApprovalPrompt('force');
$client->setAccessType('offline');
$client->addScope("email");
$client->addScope("https://spreadsheets.google.com/feeds");

$oauth2 = new Google_Service_Oauth2($client);


$GLOBALS['token_store'] = "gs://".$_GLOBALS['bucket']."/james.nadeau.token";
function store_access_token($token)
{
	if(is_writable($my_bucket)
	{
		//store this token to the bucket for later use
		file_put_contents($GLOBALS['token_store'], $token);
	}
	else
	{
		echo "<p> Error writing to ".$GLOBALS['token_store'].'</p>';
	}
}

function get_access_token(&$client)
{
	//get the toekn from storage
	$token = file_get_contents($GLOBALS['token_store']);
	$token_decoded = json_decode($token, true);
	//echo '<pre>'.print_r($token_decoded, true).'</pre>';
	$time_since_created = time() - $token_decoded['created'];
	/*
	echo '<p>'
		//.time().' - '.$token_decoded['created'].' = '
		.number_format($time_since_created).' seconds since token was last used &gt; '.$token_decoded['expires_in']
	.'</p>';
	*/
	if($time_since_created > $token_decoded['expires_in']) {
		//echo '<p>Going to refresh with '.$token_decoded['refresh_token'].' </p>';
		
		//refresh the token
		$client->refreshToken($token_decoded['refresh_token']);
		//echo '<pre>'.print_r($token_decoded, true).'</pre>';
		$token = json_decode($client->getAccessToken(), true);
		
		$token['refresh_token'] = $token_decoded['refresh_token'];
		$token = json_encode($token);
		
		store_access_token($token);
	}
	return $token;
}

//from http://stackoverflow.com/a/853898/1978759
function get_random_string()
{
	$valid_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYG0123456789';
	$length = 5;
    // start with an empty random string
    $random_string = "";

    // count the number of chars in the valid chars string so we know how many choices we have
    $num_valid_chars = strlen($valid_chars);

    // repeat the steps until we've created a string of the right length
    for ($i = 0; $i < $length; $i++)
    {
        // pick a random number from 1 up to the number of valid chars
        $random_pick = mt_rand(1, $num_valid_chars);

        // take the random character out of the string of valid chars
        // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
        $random_char = $valid_chars[$random_pick-1];

        // add the randomly-chosen char onto the end of our string so far
        $random_string .= $random_char;
    }

    // return our finished random string
    return $random_string;
}
