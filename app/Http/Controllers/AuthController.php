<?php

namespace App\Http\Controllers;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request){
       return "Login Successfull";
    }

    public function register(Request $request){
        return "Register Successfull";
    }

    public function logout(Request $request){
        return \response()->json("Logout Successfull");
    }

}
