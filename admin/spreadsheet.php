<?php

include('access_token.php');

//set up spreadsheet factory
//from:https://github.com/asimlqt/php-google-spreadsheet-client
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

//echo '<p>Using existing token</p>';
$access_token = get_access_token($client);
//echo '<pre>'.print_r($access_token, true).'</pre>';
$client->setAccessToken($access_token);

if ($client->getAccessToken()) {
	//we have access!
	
	//magic to actually get the token this library wants
	$token_decoded = json_decode($access_token, true);
	//echo '<pre>'.print_r($token_decoded, true).'</pre>';
	//create spreadsheet factory
	$serviceRequest = new DefaultServiceRequest($token_decoded['access_token']);
	ServiceRequestFactory::setInstance($serviceRequest);
	
}


$spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
$spreadsheetFeed = $spreadsheetService->getSpreadsheets();

//echo '<pre>'.print_r($spreadsheetFeed, true).'</pre>';
$spreadsheet = $spreadsheetFeed->getByTitle('Guest List');
//echo '<pre>'.print_r($spreadsheet, true).'</pre>';
$worksheetFeed = $spreadsheet->getWorksheets();
$worksheet = $worksheetFeed->getByTitle('List');
$listFeed = $worksheet->getListFeed();

$rows = array();
$entries = array();
foreach ($listFeed->getEntries() as $entry) {
	$values = $entry->getValues();
	
	//add random code to value and save it
	//$values['code'] = get_random_string();
	//$entry->update($values);
	
	$entries[] = $entry;
	$rows[] = $values;
	//echo '<pre>'.print_r($values, true).'</pre>';
}

$GLOBALS['entries'] = $entries;
$GLOBALS['rows'] = $rows;

//echo '<pre>'.print_r($entries, true).'</pre>';
//echo '<pre>'.print_r($rows, true).'</pre>';

function find_by_rsvp_code($code) {
	foreach($GLOBALS['rows'] as $key => $value) {
		if($value['code'] == $code)
			return array('values' => $value, 'entry' => $GLOBALS['entries'][$key]);
	}
	return false;
}