<?php
namespace App\app\Http\Controllers;

use App\config\App;
use App\config\Controller;
use App\config\Route;
use App\config\Request;

class InternshipController extends Controller 
{


    #[Route("GET", "/")]
    public function index()
    {
        App::$app->view("index");
    }
 
}

