<?php

// Carrega as rotas
require_once __DIR__ . '../../src/config/routes.php';

$url = $_SERVER['REQUEST_URI'];
$url_parts = explode('?', $url);
$url = $url_parts[0];
$url = str_replace('/mercado', '', $url);

if (preg_match('/^\/products\/edit\/(\d+)$/', $url, $matches)) {
    $id = $matches[1];
    $controller = 'ProductsController';
    $action = 'edit';
} elseif (preg_match('/^\/products\/delete\/(\d+)$/', $url, $matches)) {
    $id = $matches[1];
    $controller = 'ProductsController';
    $action = 'delete';
} elseif (preg_match('/^\/product_types\/edit\/(\d+)$/', $url, $matches)) {
    $id = $matches[1];
    $controller = 'ProductTypesController';
    $action = 'edit';
} elseif (preg_match('/^\/product_types\/delete\/(\d+)$/', $url, $matches)) {
    $id = $matches[1];
    $controller = 'ProductTypesController';
    $action = 'delete';
} elseif (preg_match('/^\/sales\/edit\/(\d+)$/', $url, $matches)) {
    $id = $matches[1];
    $controller = 'SalesController';
    $action = 'edit';
} elseif (preg_match('/^\/sales\/delete\/(\d+)$/', $url, $matches)) {
    $id = $matches[1];
    $controller = 'SalesController';
    $action = 'delete';
} elseif (isset($routes[$url])) {
    $route = $routes[$url];
    $controller = $route['controller'];
    $action = $route['action'];
} else {
    die('Página não encontrada');
}

$controller_file = dirname(__DIR__) . '/src/controllers/' . $controller . '.php';

if (!file_exists($controller_file)) {
    die('Controlador não encontrado');
}

require_once $controller_file;
$controller_class = '\\App\\Controllers\\' . $controller;

$controller_instance = new $controller_class();

if ($action == 'edit' || $action == 'delete') {
    $controller_instance->$action($id);
} else {
    $controller_instance->$action();
}