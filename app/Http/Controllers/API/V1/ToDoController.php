<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Models\ToDo;
use Illuminate\Http\Request;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $todos = ToDo::all();
            return response()->json([
                'success' => true,
                'todo' => $todos,
            ],200);

        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $todo = ToDo::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return response()->json([
                'success' => true,
                'todo_id' => $todo->id,
            ],200);
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $todo = ToDo::FindOrFail($id);
            return response()->json([
                'success' => true,
                'todo' => $todo,
            ],200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $todo = ToDo::FindOrFail($id);
            return response()->json([
                'success' => true,
                'todo' => $todo,
            ],200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $todo = ToDo::where('id', $id)
                ->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);

            return response()->json([
                'success' => true,
                'todo' => $id,
            ],200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $todo = ToDo::destroy($id);

            return response()->json([
                'success' => true,
                'todo_id' => $id,
            ],200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
    }
}
