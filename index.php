<?php 
    declare(strict_types=1);
    include("controllers/product.controller.php");
    include("database/db.php");
    include("database/Users.php");
    include_once("utils/Request.php");
    include_once("routes/Router.php");

    use controllers as controller;

    $req = new Request();
    $router = new Router($req);

    $router->get('/getProduct', function($req) {
         print_r($req);
    });

    $router->post('/getProduct', controller\Product::createProduct); 

    $router->put('/getProduct', function($req) {
         $body = $req->getBody();
        return json_encode($body);
    }); 


?>