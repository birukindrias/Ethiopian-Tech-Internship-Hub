<?php

namespace App\app\Http\Controllers;

use App\app\Http\Models\User;
use App\config\App;
use App\config\Controller;
use App\config\Request;
use App\config\Route;

class UserController extends Controller
{   
    // #[Route('GET', '/')]
    public function index()
    {
        App::$app->view('index');
    }
    #[Route('GET', '/create')]

    public function create()
    {
        App::$app->view('users/create');
    }
    #[Route('POST', '/store')]

    public function store()
    {
        $request = new Request(); 
        $user = new User();
        // $data = validate([
        //     $request->name => 'required|max:255',
        // ])
//         $user->save(['name'=> $request->get('name')]);
$user->save(['name' =>  $request->get('name')]);
//         ->with('success','created acc')
        return $this->redirect('/');
    }
    

    #[Route('GET', '/edit')]
 

    public function edit()
    {
        App::$app->view('users/create');
    }
    #[Route('GET', '/api/')]
    public function api()
    {
        App::$app->view('index');
    }
}
