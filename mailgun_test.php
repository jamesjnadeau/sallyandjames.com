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
    'from'    => 'james.nadeau@gmail.com',
    'to'      => 'testers@sallyandjames.com',
    'subject' => 'Save the date test',
    'html'    => $html
));
print_r($result);