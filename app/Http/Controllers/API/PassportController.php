<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PassportController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::query()->create($input);
        $success = $user->createToken('CodeLine');
        return response()->json(['accessToken' => $success->accessToken, 'expires_at' => $success->token->expires_at], 200);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success = $user->createToken('CodeLine');
            return response()->json(['accessToken' => $success->accessToken, 'expires_at' => $success->token->expires_at], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function getAuthenticatedUser()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }
}
