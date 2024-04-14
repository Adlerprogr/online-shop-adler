<?php

use Core\App;
use Core\Autoloader;

require_once './../Core/App.php';
require_once './../Core/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->registration();

$app = new App();
$app->run();