<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Cookie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request){
        try {
            $http = new \GuzzleHttp\Client;
            $response = $http->post('http://localhost/dirname/public/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_secret' => 'CFFtRTuUqJ9KBF2rwIpyR3XXlL8i7sbUlIvpTk2o',
                    'username' => $request->username,
                    'password' => $request->password,
                    'scope' => ''
                ],
            ]);

            $token = json_decode($response->getBody(), true);

            $refresh_token = $token['refresh_token'];

            return response()->json([ 'token' => $token, 'refresh_token' => $refresh_token ])->cookie('uuidpandaisuite', $refresh_token, 360);

        }
        catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getCode() === 400) {
                return response()->json('Use right credention! 400', $e->getCode());
            } else if($e->getCode() === 401) {
                return response()->json('Use right credention!. 401', $e->getCode());
            }

            response()->json('Something wrong on the server.', $e->getCode());
        }
    }

    public function refreshToken(Request $request){
        $value = $request->cookie('uuidpandaisuite');

        try {
            $http = new \GuzzleHttp\Client;

            $response = $http->post('http://localhost/dirname/public/oauth/token', [

                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $value,
                    'client_id' => 2,
                    'client_secret' => 'CFFtRTuUqJ9KBF2rwIpyR3XXlL8i7sbUlIvpTk2o'
                ],
            ]);

            $token = json_decode((string) $response->getBody(), true);

            $refresh_token = $token['refresh_token'];

            return response()->json([ 'token' => $token, 'refresh_token' => $refresh_token ])->cookie('uuid', $refresh_token, 360);
        }
        catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getCode() === 400) {
                return response()->json('Use right credention!...', $e->getCode());
            } else if($e->getCode() === 401) {
                return response()->json('Use right credention!. Sign In again', $e->getCode());
            }

            response()->json('Something wrong on the server.', $e->getCode());
        }
    }

    public function logout()
    {
        $user = auth()->user();

        if(auth()->check()) {
            auth()->user()->tokens->each(function($token, $key) {
                $token->delete();
            });
        }

        return response()->json('You are log out')->withCookie(Cookie::forget('uuidpandaisuite'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['string', 'min:3', 'confirmed'],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        return $user;
    }
}
