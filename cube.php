<?php

define('DS', DIRECTORY_SEPARATOR);

require_once 'main/boot/vars.php';
require_once 'vendor/autoload.php';

use App\Core\Helpers\Cli\Cli;

$cli = new Cli($argv);
$cli->listen();