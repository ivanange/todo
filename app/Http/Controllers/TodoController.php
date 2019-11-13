<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $validated = (Object)$request->validate([
            'after' => 'nullable|date',
            'search' => 'nullable|string',
            'dateline' => 'nullable|date',
            'state' => 'nullable|integer',
        ]);

        return Todo::when($request->after, function($q, $after)  {
            return $q->where("updated_at", ">", $after);
        })->when($request->search, function($q, $search)  {
            return $q->where("tilte", "like", "%$search%" )->orWhere("description", "like", "%$search%" );
        })->when($request->state, function($q, $state)  {
            return $q->where("state", "like", $state );
        })->when($request->dateline, function($q, $dateline)  {
            return $q->where("dateline", "<=", $dateline );
        })->get()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer',
            'description' => 'nullable|string',
            'title' => 'required_if:id,null|string',
            'dateline' => 'nullable|date',
            'state' => 'nullable|integer',
        ]);

        $todo = Todo::firstOrNew(["id"=> $request->id ?? 0]);
        $todo->fill($validated);
        $todo->save(); 
        return $todo->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return $todo->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    public function apiFallback()
    {
        return response()->json("",404);
    }

    public function webFallback()
    {
        return view('app');
    }
}
