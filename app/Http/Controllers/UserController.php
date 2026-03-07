<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // public function index(){
    //     $user = User::find(2);
    //     return dd($user);
    // }
    public function index(){
//        $users = User::all();
//        foreach($users as $user)
//        {
//            if(!($user->id % 2 == 0))
//            {
//                dump($user->id . "\n" . $user->name);
//            }
//        }
//        return dd($users);
        $users = User::all();
        return view('users', compact('users'));
    }
}
