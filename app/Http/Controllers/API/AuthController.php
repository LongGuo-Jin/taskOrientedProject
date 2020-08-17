<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 8/13/2020
 * Time: 3:13 PM
 */
namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function Login(Request $request) {

        $credentials = [
          'email' => $request->email,
          'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('TaskOrientedProjects')->accessToken;
            return response()->json(['success' => $success]);
        } else {
            return response()->json(['error' => 'Unauthorized'],401);
        }
    }
}