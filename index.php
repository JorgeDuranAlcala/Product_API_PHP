<?php 

    include("controllers/product.controller.php");
    include("database/db.php");
    include("database/Users.php");

    use controllers as controll;
    use database as mydb;

    //echo controll\Product::sayHello();

    $users = new mydb\Users();


?>