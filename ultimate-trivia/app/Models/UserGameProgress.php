<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGameProgress extends Model
{
    use HasFactory;

    protected $table = 'user_game_progress';

    protected $primaryKey = 'user_game_progress_id';

    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'game_id',
        'level',
        'high_score',
        'last_played',
        'score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
