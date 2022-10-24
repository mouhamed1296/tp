<?php

declare(strict_types=1);
require_once __DIR__."/vendor/autoload.php";

use App\Controllers\AuthController;
use App\Router;

$router = new Router();

$router->get("/", [AuthController::class, "form"]);

$router->post("/", [AuthController::class, "authenticate"]);

$router->get("/inscription", function(){
    echo "Inscription";
});

$router->addNotFoundHandler(function(){
    $title = "Page Non Trouvé";
    require_once __DIR__."/src/Views/404.phtml";
});


$router->run();