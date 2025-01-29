<?php
//declare(strict_types=1);

require __DIR__ . '/Router.php';
require_once __DIR__ . '/App/controller/AuthController.php';

use AuthMVC\App\controller\AuthController\AuthController;


session_start();
print_r($_SESSION);
$authController = new AuthController();
$authController->handleRequest();

// if (isset($_SESSION['username'])) {
//    echo "Welcome " . $_SESSION['username'];
// } else {
//    echo "Not logged in";
// }

// print_r($_POST);
// print_r(1);


//require __DIR__ . '/App/views/register.php';

//$path = str_replace('/AuthMVC', '', parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

//$router = new RouteCollector();
//
//$router->get("/", function () {
//    return 'Hello World!';
//});
//
//$router->get("/about", function () {
//    return 'About Page';
//});
//
//$dispatcher = new Dispatcher($router->getData());
//
//try {
//    $response = $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $path);
//    echo $response;
//} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
//    echo "404 Not Found";
//} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
//    echo "405 Method Not Allowed";
//}

//require_once 'Router.php';
//$router = new Router();
//
//$router->add($path, function () {
//    if ($_SERVER['REQUEST_URI'] !== '/AuthMVC/index.php') {
//        header("Location: /AuthMVC/index.php");
//        exit();
//    }
//});

//$router->add('/AuthMVC/', function () {
//    if ($_SERVER['REQUEST_URI'] !== '/AuthMVC/index.php') {
//        header("Location: /AuthMVC/index.php");
//        exit();
//    }
//});
//$router->add('/AuthMVC/App/views/login.php', function () {
//    header("Location: /AuthMVC/App/views/login.php");
//    exit();
//});

//$router->dispatch($path);
//echo 1;
//switch ($path) {
//    case '/AuthMVC/App/views/login.php':
//    case '/':
//        header("Location: /AuthMVC/App/views/login.php");
//        break;
//    case '/AuthMVC/App/views/register.php':
//        header("Location: /AuthMVC/App/views/register.php");
//        break;
//    case '/AuthMVC/index.php':
//        header("Location: /AuthMVC/index.php");
//}

