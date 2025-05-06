<?php

namespace App\config;

 class Request
{
    public function get($name)
    {
        return $_POST[$name];
        // return header("location " . $name);
    }
}
