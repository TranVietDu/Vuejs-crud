<?php

namespace App\Repositories;
use App\Models\Todo;

interface TodoInterface
{
   public function all();
   public function find($id);
}