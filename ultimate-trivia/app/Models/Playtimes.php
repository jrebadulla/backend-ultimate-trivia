<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playtimes extends Model
{
    use HasFactory;

    protected $table = 'quiz_playtimes';

    protected $fillable = ['user_id', 'game_id', 'day', 'playtime'];
}
