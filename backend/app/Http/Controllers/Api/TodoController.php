<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\TodoCollection;
use App\Repositories\TodoInterface;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $todoRepository;
    public function __construct(TodoInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }
    public function index()
    {
        $todos=$this->todoRepository->all();
        return TodoCollection::collection($todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $todo=new Todo;
        $todo->fill($request->all());
        $todo->save();
        $todos=$this->todoRepository->all();
        return TodoCollection::collection($todos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo=$this->todoRepository->find($id);
        return response()->json($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo=$this->todoRepository->find($id);
        return TodoCollection::collection($todo);
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
        $todo=$this->todoRepository->find($id);
        $todo->fill($request->all());
        $todo->save();
        return response()->json('Todo updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo=$this->todoRepository->find($id);
        $todo->delete();
        $todos=$this->todoRepository->all();
        return TodoCollection::collection($todos);
    }
}
