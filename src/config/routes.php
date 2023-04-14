<?php

$routes = array(
    '/' => array(
        'controller' => 'SalesController',
        'action' => 'index'
    ),
    '/products' => array(
        'controller' => 'ProductsController',
        'action' => 'index'
    ),
    '/products/add' => array(
        'controller' => 'ProductsController',
        'action' => 'add'
    ),
    '/products/edit/:id' => array(
        'controller' => 'ProductsController',
        'action' => 'edit'
    ),
    '/products/update' => array(
        'controller' => 'ProductsController',
        'action' => 'update'
    ),
    '/products/delete/:id' => array(
        'controller' => 'ProductsController',
        'action' => 'delete'
    ),
    '/product_types' => array(
        'controller' => 'ProductTypesController',
        'action' => 'index'
    ),
    '/product_types/add' => array(
        'controller' => 'ProductTypesController',
        'action' => 'add'
    ),
    '/product_types/edit/:id' => array(
        'controller' => 'ProductTypesController',
        'action' => 'edit'
    ),
    '/product_types/update' => array(
        'controller' => 'ProductTypesController',
        'action' => 'update'
    ),
    '/product_types/delete/:id' => array(
        'controller' => 'ProductTypesController',
        'action' => 'delete'
    ),
    '/sales' => array(
        'controller' => 'SalesController',
        'action' => 'index'
    ),
    '/sales/add' => array(
        'controller' => 'SalesController',
        'action' => 'add'
    ),
    '/sales/edit/:id' => array(
        'controller' => 'SalesController',
        'action' => 'edit'
    ),
    '/sales/update' => array(
        'controller' => 'SalesController',
        'action' => 'update'
    ),
    '/sales/delete/:id' => array(
        'controller' => 'SalesController',
        'action' => 'delete'
    ),
);

function route($url) {
    global $routes;

    // Remove a barra do final da URL, se existir
    $url = rtrim($url, '/');

    // Percorre as rotas definidas
    foreach ($routes as $route => $info) {
        // Substitui os parâmetros na URL por expressões regulares
        $route = preg_replace('/:[a-z]+/', '([a-z0-9-]+)', $route);

        // Adiciona delimitadores para as expressões regulares
        $route = '#^' . $route . '$#';

        // Verifica se a URL atual corresponde à rota definida
        if (preg_match($route, $url, $matches)) {
            // Remove o primeiro item do array de matches
            array_shift($matches);

            // Define o controller e a action a serem executados
            $controller = $info['controller'];
            $action = $info['action'];

            // Instancia o controller e chama a action correspondente
            require_once "../controllers/{$controller}.php";
            $controller = new $controller();
            call_user_func_array(array($controller, $action), $matches);

            return;
        }
    }
}
