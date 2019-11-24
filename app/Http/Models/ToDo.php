<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $table = 'todos';
    protected $fillable = ['title', 'description'];
}
