<?php

use google\appengine\api\cloud_storage\CloudStorageTools;
$GLOBALS['bucket'] = CloudStorageTools::getDefaultGoogleStorageBucketName();
$file = "gs://".$GLOBALS['bucket']."/test.txt";
file_put_contents($file, 'This is a test, please work' );
sleep(2);
echo file_get_contents($file);