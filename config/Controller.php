<?php

namespace App\config;

abstract class Controller
{
    public function redirect($path)
    {
        var_dump($path);
        return  header("location: " . $path);

    }
}
