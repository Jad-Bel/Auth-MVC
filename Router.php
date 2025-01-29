<?php

if (isset($_GET['page'])){
    $page = $_GET['page'] ?? 'index';
    switch ($page) {
        case '/':
            require __DIR__ . '/../AuthMVC/index.php';
            break;
        default:
            $filename = __DIR__ . '/App/views/' . basename($page) . '.php';
            if (file_exists($filename)) {
                require $filename;
                break;
            }
            
        }
        // echo $page;
        // exit();
    }

//
//class Router {
//    private  $routes = [];
//    public function add ($path, $handler) {
//        $this->routes[$path] = $handler;
//
//    }
//
//    public function dispatch ($path)
//    {
//        foreach ($this->routes as $route => $handler) {
//            $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);
//
//            if (preg_match("#^$pattern$#", $path, $matches)) {
//                array_shift($matches);
//                call_user_func_array($handler, $matches);
//                return;
//            }
//        }
//
//        echo "404 Not Found";
//    }
//}
