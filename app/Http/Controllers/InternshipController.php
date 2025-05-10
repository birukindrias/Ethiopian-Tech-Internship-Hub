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
    public function index(Request $request)
    {
        $internship = new Internship();
        redirect('/store',['msg'=>"Internship created successfully"]);
        view("index",['internships' => $request->get('name')]);
    }
 
}

