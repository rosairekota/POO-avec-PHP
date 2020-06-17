<?php

define('ROOT', dirname(__DIR__));
require ROOT . '/src/App.php';


$app = App::run();



//TRAITEMENT DE NOS ROUTES AVEC NOTRE ROUTEUR
// $routeur =new \Routeur(ROOT .'/views');
// $routeur->get('/','admin/home','home')
//         ->get('/admin','admin/post','post')
//         ->run();



    if (isset($_GET['p']) && !empty($_GET['p'])) {
        $p = $_GET['p'];
    } else {
        $p = 'home';
    }

    // Auth
  

    ob_start();
    if ($p === 'home') {
        require ROOT . '/views/blog/home.html.phtml';
    } elseif ($p === 'post.show') {
        require ROOT . '/views/blog/show.html.phtml';
    } elseif ($p === 'category') {
        require ROOT . '/views/blog/category.html.phtml';
    }
     elseif ($p === 'login') {
        require ROOT . '/views/users/login.html.phtml';
    }
    $pageContent = ob_get_clean();

    require  ROOT . '/views/layouts/default.html.phtml';