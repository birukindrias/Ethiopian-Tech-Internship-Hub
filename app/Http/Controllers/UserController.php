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
        view('index');
    }
    #[Route('GET', '/create')]

    public function create()
    {
        view('users/create');
    }
    #[Route('GET', '/store')]

    public function store(Request $request)
    {
        var_dump($request->get('name'));
        $data = $request->validate([
            'name' => 'required|max:255|string',
            // 'email' => 'required|email|max:255|unique:users,email',
            // 'password' => 'required|min:8|max:255|string',
            // 'password_confirmation' => 'required|min:8|max:255|string',
        ]);

        $user = new User();
        $user->save($data);
        //         $user->save(['name'=> $request->get('name')]);
        $user->save(['name' =>  $request->get('name')]);
        view('users/create');

        //         ->with('success','created acc')
        // return $this->redirect('/');
    }


    #[Route('GET', '/edit')]


    public function edit()
    {
        view('users/create');
    }
    #[Route('GET', '/api/')]
    public function api()
    {
        view('index');
    }
}
