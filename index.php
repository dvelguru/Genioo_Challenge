<?php

define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('APP_DIR', 'app');

require ROOT . DS . APP_DIR . DS . 'init.php';

$app = new App;