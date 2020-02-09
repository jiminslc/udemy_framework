<?php

/**
 * Front controller
 * 
 * PHP version 7.2
 */
//echo '<pre>';var_dump($_SERVER);echo '</pre>';die;

require '../Core/Router.php';

$router = new Router();

// Add the routes

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');

// Display the routing table
echo '<pre>';
// var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

$url = $_SERVER['QUERY_STRING'];
//echo '<pre>';var_dump($router);echo '</pre>';die;
if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}