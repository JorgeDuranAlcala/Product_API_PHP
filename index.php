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
    $myControl = new controller\Product();

    
    $router->get('/getProduct', [$myControl, "getAllProducts"]);

    $router->post('/getProduct', [$myControl, "createProduct"]); 

    $router->post('/getProduct', [$myControl, "updateProduct"]); 


?>