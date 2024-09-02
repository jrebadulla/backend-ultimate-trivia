<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGameProgress extends Model
{
    use HasFactory;

    protected $table = 'user_game_progress';

    protected $primaryKey = 'user_game_progress_id';

    protected $fillable = [
        'user_id',
        'game_id',
        'level',
        'high_score',
        'last_played',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function games()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
