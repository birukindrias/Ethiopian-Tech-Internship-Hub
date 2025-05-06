<?php

namespace App\config;

// use App\app\Http\Controllers\UserController;


use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(
        public string $method,
        public string $path
    ) {}
}
