<?php
# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-3c7d9aa50873d70b15a2c9b29f39c324');
$domain = "sallyandjames.com";
$html = file_get_contents('savethedate.html');
# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'savethedate@sallyandjames.com',
    //'to'      => 'date@sallyandjames.com',
    //'to'      => 'abroderick8@gmail.com',
    //'to'      => 'michael.haseck@gmail.com',
    'to'      => 'ava@sover.net',
    
    'subject' => 'Sally and James are Getting Married',
    'html'    => $html,
	//test
	//'o:campaign' => 'dbfce'
	//save the date
	'o:campaign' => 'ddyy8'
));
print_r($result);