<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class ToDoController extends Controller
{
    public function index()
    {
        try
        {
            $client = new Client();
            $response = $client->get(config('todoapp.todo_api_link') . '/todos')->getBody();
            if(json_decode($response)->success){
                $todos = json_decode($response)->todo;
                return view('todos.list')
                    ->with('todos', $todos);
            }else{
                return response()->json(
                    ['success' => false,
                        'error' => 'No todos found '
                    ], 401);
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }
    public function create()
    {
        return view('todos.add');
    }

    public function store(Request  $request)
    {
        try
        {
            $data = $request->only('title', 'description');
            $rules = [
                'title'         => 'required|max:255',
                'description'   => 'required',
            ];
            $validator  = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = $validator->messages();
                return redirect()->back()->withErrors($errors);
            }

            $data = [
                'title'         => $request->title,
                'description'   => $request->description,
            ];

            $client = new Client();
            $options = [
                'http_errors' => true,
                'force_ip_resolve' => 'v4',
                'connect_timeout' => 5,
                'read_timeout' => 5,
                'timeout' => 5,
            ];
            $response = $client->request('POST', config('todoapp.todo_api_link') . '/todos/add', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                'body' => json_encode($data),
                $options
            ])->getBody();
            if(json_decode($response)->success){
                Session::flash('success', 'New todo added successfully.');
                return redirect(route('todo.list'));
            }else{
                Session::flash('failed', 'Adding new todo failed.');
                return redirect(route('todo.list'));
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }

    }

    public function edit($id)
    {
        try
        {
            $client = new Client();
            $response = $client->get(config('todoapp.todo_api_link') . '/todos/show/'.$id)->getBody();
            if(json_decode($response)->success){
                $todo = json_decode($response)->todo;
                return view('todos.update')
                    ->with('todo', $todo);
            }else{
                return response()->json(
                    ['success' => false,
                        'error' => 'No todos found '
                    ], 401);
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }

    }

    public function update(Request $request)
    {
        try
        {
            $data = $request->only('id', 'title', 'description');
            $rules = [
                'title'         => 'required|max:255',
                'description'   => 'required',
            ];
            $validator  = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = $validator->messages();
                return redirect()->back()->withErrors($errors);
            }

            $data = [
                'id'            => $request->todo_id,
                'title'         => $request->title,
                'description'   => $request->description,
            ];
            $client = new Client();
            $options = [
                'http_errors' => true,
                'force_ip_resolve' => 'v4',
                'connect_timeout' => 5,
                'read_timeout' => 5,
                'timeout' => 5,
            ];
            $response = $client->patch(config('todoapp.todo_api_link') . '/todos/update/'.$request->todo_id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                'body' => json_encode($data),
                $options
            ])->getBody();
            if(json_decode($response)->success){
                Session::flash('success', 'Todo updated successfully.');
                return redirect(route('todo.list'));
            }else{
                Session::flash('failed', 'Updating new todo failed.');
                return redirect(route('todo.list'));
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    public function destroy($id)
    {
        try
        {
            $data = [
                'id'            => $id,
            ];
            $client = new Client();
            $options = [
                'http_errors' => true,
                'force_ip_resolve' => 'v4',
                'connect_timeout' => 5,
                'read_timeout' => 5,
                'timeout' => 5,
            ];
            $response = $client->delete(config('todoapp.todo_api_link') . '/todos/delete/'.$id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                'body' => json_encode($data),
                $options
            ])->getBody();
            if(json_decode($response)->success){
                return 'success';
            }else{
                Session::flash('failed', 'Deleting new todo failed.');
                return redirect(route('todo.list'));
            }
        } catch (\Exception $e) {
            $error_message = $e->getMessage(); deleted
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }
}
