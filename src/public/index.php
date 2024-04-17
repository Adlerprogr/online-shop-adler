<?php

use Core\App;
use Core\Autoloader;

require_once './../Core/App.php';
require_once './../Core/Autoloader.php';

$dir = dirname(__DIR__);

Autoloader::registration($dir);

$app = new App();
$app->run();