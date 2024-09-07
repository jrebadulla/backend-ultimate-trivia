<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $primaryKey = 'answer_id';
    protected $fillable = ['answer_text', 'question_id','game_id'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'game_id', 'game_id');
    }


}
