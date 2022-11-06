<?php

declare(strict_types=1);
require_once __DIR__."/vendor/autoload.php";

use App\Controllers\{
    AddUserController,
    AuthController,
    AdminController,
    ProfileController,
    SearchUserController,
    UpdateController,
    UserController
};
use App\Router;

$router = new Router();

$router->get("/", [AuthController::class, "form"]);

$router->post("/", [AuthController::class, "authenticate"]);
$router->get("/logout", [AuthController::class, "logout"]);

$router->get("/inscription", [AddUserController::class, "form"]);

$router->post("/inscription", [AddUserController::class, "signup"]);
$router->get("/admin", [AdminController::class, "home"]);
$router->get("/user", [UserController::class, "home"]);
$router->post("/switch-role", [AdminController::class, "switch"]);
$router->get("/archives", [AdminController::class, "archives"]);
$router->get("/userArchives", [UserController::class, "archives"]);
$router->post("/archiveUser", [AdminController::class, "draftUser"]);
$router->post("/desarchiveUser", [AdminController::class, "undraftUser"]);
$router->get("/update", [AdminController::class, "updateForm"]);
$router->post("/update", [AdminController::class, "update"]);
$router->post("/searchUndrafted", [SearchUserController::class, "searchUndrafted"]);
$router->post("/searchDrafted", [SearchUserController::class, "searchDrafted"]);
$router->post("/updatePassword", [ProfileController::class, "updatePassword"]);
$router->post("/updateProfilePhoto", [ProfileController::class, "updateProfilePhoto"]);


$router->addNotFoundHandler(function(){
    $title = "Page Non Trouvé";
    require_once __DIR__."/src/Views/404.phtml";
});


$router->run();