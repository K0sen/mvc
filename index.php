<?php
define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT', __DIR__ . DS);
define ('VIEW_DIR', ROOT . "View" . DS);
define ('LIB_DIR', ROOT . 'Library' . DS);
define ('CONTROLLER_DIR', ROOT . 'Controller' . DS);


/**
 * @param $className
 */
function __autoload($className)
{
    $file = "{$className}.php";

    if (file_exists(LIB_DIR . $file)){
        require LIB_DIR . $file;
    } else if (file_exists(CONTROLLER_DIR . $file)){
        require CONTROLLER_DIR . $file;
    } else {
        die("{$file} not found");
    }
}

$request = new Request();

$route = $request->get('route');
if (is_null($route)){
    $route = "index/index";
}

$route = explode('/', $route);

if (!$route[0] || !$route[1]){
    $route[0] = 'index';
    $route[1] = 'index';
}
$controller = ucfirst(strtolower($route[0])) . 'Controller'; // book -> BookController
$action = strtolower($route[1]) . 'Action';   // index -> indexAction

$controller = new $controller();

if (!method_exists($controller, $action)){
    die("{$action} not found");
}
$content = $controller->$action($request);


require VIEW_DIR . "default_layout.phtml";



echo '<hr><b>Debug:</b><br>';

echo "<pre>";
var_dump($route, $controller, $action);
echo "</pre>";



