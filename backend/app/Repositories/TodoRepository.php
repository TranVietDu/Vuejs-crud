<?php

namespace App\Repositories;

use App\Models\Todo;

use App\Repositories\TodoInterface;

class TodoRepository implements TodoInterface
{
   public function all()
   {
       return Todo::all();
   }
   public function find($id){
       return Todo::find($id);
   }
}