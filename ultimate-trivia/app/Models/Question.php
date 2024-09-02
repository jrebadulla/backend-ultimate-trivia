<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    public $incrementing = false;

    public $timestamps = false;
    protected $fillable = [
        'question_id',
        'game_id',
        'level_id',
        'question_text',
        'correct_answer',
        'option_a',
        'option_b',
        'option_c',
        'option_d',

    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class, 'question_id', 'question_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }
}
