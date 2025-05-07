<?php

namespace App\config;

use App\app\Http\Controllers\UserController;
use App\config\Route;
use PDO;
use ReflectionClass;

class App
{

    public array $routes;
    public $layout = "app";
    private $conn;
    public Database $db;
    public static $app;
    public function __construct($an = '')
    {
        try {
            //code...
     
        self::$app = $this;

       
        if ($an === 'db') {
            $this->env();
            $this->db = new Database();
            return;
        } else {

            $this->env();
            $this->db = new Database();

            $this->router();

        }
    } catch (\Throwable $e) {
        http_response_code(500);
        echo "ControllerERROR: " . $e->getMessage();
        exit;
    }
    }
    public function router()
    {



        $routes = [];

        // 1. Set your controller folder and base namespace
        $controllerDir = __DIR__ . '/../app/Http/Controllers';
        $baseNamespace = 'App\\app\\Http\\Controllers\\';

        // 2. Scan all PHP files in the controller folder
        $controllerFiles = glob("$controllerDir/*.php");

        foreach ($controllerFiles as $file) {
            require_once $file;

            $className = $baseNamespace . basename($file, '.php');

            if (!class_exists($className)) continue;

            $ref = new ReflectionClass($className);

            foreach ($ref->getMethods() as $method) {
                foreach ($method->getAttributes(Route::class) as $attr) {
                    $route = $attr->newInstance();
                    $key = "{$route->method}:{$route->path}";
                    $routes[$key] = [$className, $method->getName()];
                }
            }
        }

        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $key = "$method:$uri";

        if (isset($routes[$key])) {
            [$class, $methodName] = $routes[$key];
         
            try {
                $controller = new $class();
                $controller = new $class();
                echo $controller->$methodName();
            } catch (\Throwable $e) {
                http_response_code(500);
                echo "Controller instantiation failed: " . $e->getMessage();
                exit;
            }
        } else {
            http_response_code(404);
            return $this->view('404');
        }
    }
   public  function view($page, $data = [] ?? null)
    {

     
        if (file_exists(dirname(__DIR__) . '/resources/views/' . $page . '.php')) {
            // echo 'yes';
            // exit;
            // function render_view($viewFile) {
              
            // }
         
            echo str_replace('{content}', $this->getPage($page,$data), $this->getLayout()); // PHP is executed ✅
            return;
        } else {
           echo  $this->view('404');
            return;
        }
    }
    public function getLayout()
    {
        ob_start();
        include_once dirname(__DIR__) . '/resources/views/layout/' . $this->layout . '.php';
        return ob_get_clean();
    }
    public function getPage($page,$data)
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        $viewPath = dirname(__DIR__) . '/resources/views/' . $page . '.php';

        if (!file_exists($viewPath)) {
            return false;
        }
    
        $content = file_get_contents($viewPath);
    
        $content = preg_replace_callback('/@import\(\'(.*?)\'\)/', function ($matches) {
            $includeFile = dirname(__DIR__) . '/resources/views/' . $matches[1];
            return file_exists($includeFile) ? file_get_contents($includeFile) : " File not found: {$matches[1]}";
        }, $content);
    
        ob_start();
        eval("?>$content");
        return ob_get_clean();
    }


    public function env(?String $key = NULL, $val = null)
    {
        #scan dir 
        #get the env
        #find it from there 
        #and to set it set it from there 
        # code...
        $path = dirname(__DIR__) . '/.env';
        /*var_dump(file_get_contents($env)*/
        /*);*/

        if (!file_exists($path)) {
            throw new Exception(".env file not found at: $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // Skip comments
            if (str_starts_with(trim($line), '#')) continue;

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Remove surrounding quotes if present
            $value = trim($value, '"\'');

            putenv("$key=$value");
            $_ENV[$key] = $value;
            // $_SERVER[$key] = $value;
        }
    }
}
