<?php 
    declare(strict_types=1);
    include("controllers/product.controller.php");
    include("controllers/users.controller.php");
    include_once("utils/Request.php");
    include_once("routes/Router.php");

    use controllers as controller;
    use utils as util;

    $req = new Request();
    $router = new Router($req);
    $productControl = new controller\Product();
    $userControl = new controller\Users();


    $router->get('/', function($req) {
        header("Location: view/index.php");
    });
    $router->get('/api', [$productControl, "getAllProducts"]);
    $router->get('/api/getProductById', [$productControl, "getByIdProduct"]);
    $router->get('/api/deleteProduct', [$productControl, "deleteProduct"]);
    $router->post('/api/createProduct', [$productControl, "createProduct"]); 
    $router->post('/api/updateProduct', [$productControl, "updateProduct"]); 

    /* Authentication */

    $router->post('/api/signup', [$userControl, "signup"]);


?>