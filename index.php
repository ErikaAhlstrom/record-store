<?php

define('URLROOT', 'http://localhost/record-store/');

// Models
require_once("models/Database.php");
require_once("models/Model.php");
// require_once("models/CartModel.php");

// Views
require_once("views/View.php");
// require_once("views/CartView.php");

// Controllers
require_once("controllers/Controller.php");
require_once("controllers/CartController.php");

$database = new Database("recordstoreDB", "root", "root");

$model = new Model($database);
$view = new View();
$controller = new Controller($model, $view);

// $controller->main();


// $cartModel = new CartModel($database);
// $cartView  = new CartView();
// $cartController = new CartController($cartModel, $cartView);

// Simple Router

$url = getUrl();
$page = $url[0] ?? "";
$param = $url[1] ?? "";

switch ($page) {
    case "":
        $controller->index();
        break;
    case "cart":
        $cartController->cart($param);
        break;
        // case "admin":
        //     $adminController->admin($param);
        //     break;
        // case "login":
        //     $controller->login();
        //     break;
        // case "register":
        //     $controller->register();
        //     break;
    default:
        $controller->index("This endpoint doesn't exist!");
        break;
}

function getUrl()
{
    if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        //print_r($url);
        return $url;
    }
}
