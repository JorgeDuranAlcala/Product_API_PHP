<?php 
    declare(strict_types=1);
    include("controllers/product.controller.php");
    include("controllers/users.controller.php");
    include_once("utils/Request.php");
    include_once("routes/Router.php");
    include_once("middlewares/Authenticate.php");
    header("Content-type: application/json");
    header("Allow-cross-origin: *");
    session_start();

    use controllers\Product;
    use controllers\Users;
    use middlewares\Authenticate;
    

    $router = new Router(new Request());
    $authenticate = new Authenticate();
    $productControl = new Product();
    $userControl = new Users();

    function Index($req)
    {
        return json_encode(array($req->data));
    }

    function middle($req, $next) {
        $req->data = "estoo es una prueba";
        return $next($req);
    }

    /* Product Operations */
    $router->get("/", [$authenticate, 'invoke'], 'Index');
    $router->get('/api', [$productControl, "getAllProducts"]);
    $router->get('/api/getProductById',[$authenticate, 'invoke'], [$productControl, "getByIdProduct"]);
    $router->get('/api/deleteProduct', [$productControl, "deleteProduct"]);
    $router->post('/api/createProduct', [$productControl, "createProduct"]); 
    $router->post('/api/updateProduct', [$productControl, "updateProduct"]); 

    /* Authentication */

    $router->post('/api/signup', [$userControl, "signup"]);
    $router->post('/api/login', [$userControl, "login"]);


?>