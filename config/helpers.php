<?php

use App\config\App;

if (!function_exists('view')) {
    function view(string $path, array $data = [])
    {
        return App::$app->view($path, $data);
    }
}

if (!function_exists('redirect')) {

    session_start();  // Make sure session is started

    function redirect($path, $data = [])
    {
        // Store the data in the session for use after the redirect
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
    
        // Redirect to the path
        header("Location: " . $path);
        exit;  // Make sure the script ends after redirecting
    }
    function redirect($path)
    {
        var_dump($path);
        return  header("location: " . $path);
    }
}
