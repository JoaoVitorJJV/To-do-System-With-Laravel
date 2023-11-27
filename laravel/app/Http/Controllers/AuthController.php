<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function signin(LoginRequest $request)
    {
        $data = $request->validated();

        if(Auth::attempt($data)){
            $user = Auth::user();

            return response()->json([
                'error' => false,
                'user' => new UserResource($user)
            ]);
        }else{
            return response()->json([
                'error' => true
            ]);
        }

    }
}
