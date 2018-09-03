<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function login (Request $request)
    {   
        //echo($request);
        //DB::insert('insert into users (id, name,password, email) values (?, ?, ?, ?)', [1, 'Dayle','chelseaFC','sajinrules@gmail.com']);
        //return new UserResource(User::create($request));
    }
}
