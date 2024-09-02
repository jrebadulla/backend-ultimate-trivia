<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id', 'selected_answer', 'selected_answer'];
}
