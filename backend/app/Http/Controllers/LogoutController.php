<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout_user(Request $request){

        /*session()->invalidate();

        session()->regenerateToken();

        if($request->user()->currentAccessToken()->delete()){

            $data = [
                'message' => 'User logged out',
                'status' => 200,
            ];

            return response()->json($data);

        }*/

        if(Auth::logout()){
            $data = [
                'message' => 'User logged out',
                'status' => 200,
            ];
            
            return $data;
        }

        return redirect('/');
    }
}
