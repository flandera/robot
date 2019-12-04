#!/usr/bin/php

<?php
//phpinfo();

if (php_sapi_name() !== 'cli') {
	exit;
}

require __DIR__ . '../vendor/autoload.php';

use Robot\App;

$app = new App();
$app->runCommand($argv);