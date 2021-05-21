<?php

define('URLROOT', 'http://localhost/record-store/');

// Models
require_once("models/Database.php");
require_once("models/Model.php");
require_once("models/CartModel.php");
require_once("models/AdminModel.php");
require_once("models/LoginModel.php");
require_once("models/RegisterModel.php");

// Views
require_once("views/View.php");
require_once("views/CartView.php");
require_once("views/AdminView.php");
require_once("views/LoginView.php");
require_once("views/RegisterView.php");


// Controllers
require_once("controllers/Controller.php");
require_once("controllers/CartController.php");
require_once("controllers/AdminController.php");
require_once("controllers/LoginController.php");
require_once("controllers/RegisterController.php");

$database = new Database("recordstoreDB", "root", "root");

$model = new Model($database);
$view = new View();
$controller = new Controller($model, $view);

// Cart MVC
$cartModel = new CartModel($database);
$cartView  = new CartView();
$cartController = new CartController($cartModel, $cartView);

// Admin MVC
$adminModel = new AdminModel($database);
$adminView  = new AdminView();
$adminController = new AdminController($adminModel, $adminView);

// Login MVC
$loginModel = new LoginModel($database);
$loginView  = new LoginView();
$loginController = new LoginController($loginModel, $loginView);

// Login MVC
$registerModel = new RegisterModel($database);
$registerView  = new RegisterView();
$registerController = new RegisterController($registerModel, $registerView);

// Simple Router

$url = getUrl();
$page = $url[0] ?? "";
$param = $url[1] ?? "";
$id = $url[2] ?? "";

switch ($page) {
    case "":
        $controller->index();
        break;
    case "cart":
        $cartController->cart();
        break;
    case "admin":
        $adminController->admin($param, $id);
        break;
    case "login":
        $loginController->login();
        break;
    case "register":
        $registerController->register();
        break;
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
