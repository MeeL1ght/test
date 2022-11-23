<?php

use Moi\App\Controllers\ProductController;

$router = new \Bramus\Router\Router();

# Routes
$router->post('/product', function () {
    $productController = new ProductController();
    $productController->createProduct();
});

$router->get('/products', function () {
    $productController = new ProductController();
    $productController->getProducts();
});

$router->delete('/products', function () {
    $productController = new ProductController();
    $productController->removeProducts();
});

$router->delete('/product/{id}', function (int $id) {
    $productController = new ProductController();
    $productController->removeProduct($id);
});

# Run
$router->run();
