<?php
session_start();

//set up spreadsheet factory
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

include($_SERVER['DOCUMENT_ROOT'].'/admin/access_token.php');
$client->setApprovalPrompt('force');


//Basic auth management
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}


if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
	store_access_token($_SESSION['access_token']);
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if(isset($_REQUEST['existing'])) {
	echo '<p>Using existing token</p>';
	$_SESSION['access_token'] = get_access_token($client);
	
}


if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  If we're signed in, 
 ************************************************/
if ($client->getAccessToken()) {
  	$_SESSION['access_token'] = $client->getAccessToken();
	store_access_token($_SESSION['access_token']);
	
	//magic to actually get the token this library wants
	$token_decoded = json_decode($_SESSION['access_token'], true);
	
	//get/check user id/email
	$user = $oauth2->userinfo->get();
	if($user['email'] != 'james.nadeau@gmail.com')
		exit('not allowed');
	
	//create spreadsheet factory
	$serviceRequest = new DefaultServiceRequest($token_decoded['access_token']);
	ServiceRequestFactory::setInstance($serviceRequest);
	
}

//echo pageHeader("User Query - Multiple APIs");
if (
    $client_id == '<YOUR_CLIENT_ID>'
    || $client_secret == '<YOUR_CLIENT_SECRET>'
    || $redirect_uri == '<YOUR_REDIRECT_URI>') {
  echo missingClientSecretsWarning();
}
?>
<div class="box">
  <div class="request">
    <?php 
		if (isset($authUrl) 
			&& !isset($_SESSION['access_token']) ) 
		{ 
    		echo "<a class='login' href='".$authUrl."'>Connect Me!</a>";
			echo '<br/>';
			echo "<a class='login' href='?existing=true'>Use Existing</a>";
    		//echo '<pre>'.print_r($_ENV, true).'</pre>';
		} else {
      		//we are logged in!
      		echo "<h3>We are logged in <a href='?logout=true' style='float: right' >logout</a></h3>";
			echo '<p>'.$GLOBALS['bucket'].'</p>';
			echo '<h3>session</h3>';
			echo '<pre>'.print_r($token_decoded, true).'</pre>';
			echo '<h3>get_access_token</h3>';
			echo '<pre>'.print_r(json_decode(get_access_token($client), true), true).'</pre>';
			
			echo '<pre>'.print_r($user, true).'</pre>';
			echo '<pre>';
				$spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
				$spreadsheetFeed = $spreadsheetService->getSpreadsheets();
				
				//echo '<pre>'.print_r($spreadsheetFeed, true).'</pre>';
				$spreadsheet = $spreadsheetFeed->getByTitle('Guest List');
				//echo '<pre>'.print_r($spreadsheet, true).'</pre>';
				$worksheetFeed = $spreadsheet->getWorksheets();
				$worksheet = $worksheetFeed->getByTitle('List');
				$listFeed = $worksheet->getListFeed();
				
				$rows = array();
				foreach ($listFeed->getEntries() as $entry) {
					$values = $entry->getValues();
					$rows[] = $values;
					//echo '<pre>'.print_r($values, true).'</pre>';
				}
			echo '</pre>';
			
			echo '<p>Loadded '.count($rows).' rows</p>';
			
			
			$csv_storage = "gs://".$_GLOBALS['bucket'].".appspot.com/guest_list.csv";
			
			
			//load file
			if (($handle = fopen($csv_storage, "r")) !== FALSE) {
				//echo '<p>Filez zize: '.filesize($csv_storage).'</p>';
				//echo fread($handle, filesize($csv_storage));
				$csv_rows = array();
				while (($data = fgetcsv($handle)) !== FALSE) {
					//echo '<pre>'.print_r($data, true).'</pre>';
					$csv_rows[] = $data;
					//check to see if we should update 
				}
			}
			
			
			//write rows to file
			if (($handle = fopen($csv_storage, "w")) !== FALSE) {
				foreach ($rows as $key => $fields) {
					fputcsv($handle, $fields);
				}
				fclose($handle);
			}
      	}
	?>
  </div>
</div>
<?php //echo pageFooter(__FILE__);

