<?php
namespace App\app\Http\Controllers;

use App\app\Http\Models\Internship;
use App\config\App;
use App\config\Controller;
use App\config\Route;
use App\config\Request;

class InternshipController extends Controller 
{


    #[Route("GET", "/")]
    public function index()
    {
        $internship = new Internship();
        App::$app->view("index",['internships' => $internship->get()]);
    }
 
}

