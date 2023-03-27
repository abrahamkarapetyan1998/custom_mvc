<?php
require_once __DIR__ . '/router.php';
require_once 'app/controllers/CommentController.php';
$router = new Router();

$router->addRoute('GET', '/', function() {
    return view('main.php');
});

$router->addRoute('POST', '/add_comment', 'CommentController@create');
$router->addRoute('POST', '/delete_comment', 'CommentController@delete');
$router->dispatch();