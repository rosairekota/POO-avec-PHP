<?php
require_once '../app/Autoloader.php';
require_once '../app/utils.php';

use App\Autoloader;
use App\App;
use App\Config;

Autoloader::register();
$config = Config::getInstance()->getKey('db_name');



var_dump($config);

die;


if (isset($_GET['p']) && !empty($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

// INITIALISATION DES OBJETS



ob_start();
if ($p === 'home') {
    require __DIR__ . '../../pages/home.html.phtml';
} elseif ($p === 'post') {
    require __DIR__ . '../../pages/single.html.phtml';
} elseif ($p === 'category') {
    require __DIR__ . '../../pages/category.html.phtml';
}
$pageContent = ob_get_clean();

require  '../pages/templates/default.html.phtml';
