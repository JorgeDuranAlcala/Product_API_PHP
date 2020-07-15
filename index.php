<?php 
    declare(strict_types=1);
    include("controllers/product.controller.php");
    include_once("utils/Request.php");
    include_once("routes/Router.php");

    use controllers as controller;
    use utils as util;

    $req = new Request();
    $router = new Router($req);
    $myControl = new controller\Product();
    //$pro = util\Product::createProduct("huawei", "phone", 400);

    $router->get('/', function($req) {
        header("Location: view/index.php");
    });
    $router->get('/api', [$myControl, "getAllProducts"]);
    $router->get('/api/getProductById', [$myControl, "getByIdProduct"]);
    $router->get('/api/deleteProduct', [$myControl, "deleteProduct"]);
    $router->post('/api/createProduct', [$myControl, "createProduct"]); 
    $router->post('/api/updateProduct', [$myControl, "updateProduct"]); 


?>