<?php
require_once '../app/Autoloader.php';
require_once '../app/utils.php';

use App\Autoloader;
use App\Database;

Autoloader::register();


if (isset($_GET['p']) && !empty($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

// INITIALISATION DES OBJETS

$db = new Database('blog_dev');

ob_start();
if ($p === 'home') {
    require __DIR__ . '../../pages/home.html.phtml';
} elseif ($p === 'post') {
    require __DIR__ . '../../pages/single.html.phtml';
}
$pageContent = ob_get_clean();

require  '../pages/templates/default.html.phtml';
