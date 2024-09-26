<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answers';
    protected $fillable = [
        'user_id',
        'game_id',
        'question_id',
        'user_answer',
        'correct_answer',
        'is_correct',
        'time_spent',
        'game_name'
    ];

    public $timestamps = true;

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'question_id');
    }
}
