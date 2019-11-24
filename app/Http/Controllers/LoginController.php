<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        try
        {
            $credentials = $request->only('name', 'email', 'password');

            $rules = [
                'name'  => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password'  => 'required|max:255',
            ];
            $validator  = Validator::make($credentials, $rules);
            if ($validator->fails()) {
                $errors = $validator->messages();
                return redirect()->back()->withErrors($errors);
            }

            $response = json_decode(json_encode($request->all()));
            $data = [
                'name' => $response->name,
                'email' => $response->email,
                'password' => $response->password,
            ];

            $client = new Client();
            $options = [
                'http_errors' => true,
                'force_ip_resolve' => 'v4',
                'connect_timeout' => 5,
                'read_timeout' => 5,
                'timeout' => 5,
            ];
            $response = $client->request('POST', config('todoapp.todo_api_link') . '/users/register', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                'body' => json_encode($data),
                $options
            ])->getBody();
            if(json_decode($response)->status){
                return redirect(route('todo.list'));
            }else{
                Session::flash('failed', 'Register failed.');
                return redirect(route('register.form'));
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        try
        {
            $credentials = $request->only('email', 'password');

            $rules = [
                'email' => 'required|email|max:255|unique:users',
                'password'  => 'required|max:255',
            ];
            $validator  = Validator::make($credentials, $rules);
            if ($validator->fails()) {
                $errors = $validator->messages();
                return redirect()->back()->withErrors($errors);
            }

            $response = json_decode(json_encode($request->all()));
            $data = [
                'email' => $response->email,
                'password' => $response->password,
            ];

            $client = new Client();
            $options = [
                'http_errors' => true,
                'force_ip_resolve' => 'v4',
                'connect_timeout' => 5,
                'read_timeout' => 5,
                'timeout' => 5,
            ];
            $response = $client->request('POST', config('todoapp.todo_api_link') . '/users/signin', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                'body' => json_encode($data),
                $options
            ])->getBody();
            if(json_decode($response->status)){
                return redirect(route('todo.list'));
            }else{
                Session::flash('failed', 'Login failed.');
                return redirect(route('login.form'));
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }

    }
}
