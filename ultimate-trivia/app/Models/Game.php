<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $primaryKey = 'game_id';
    protected $fillable = [
        'game_name',
        'description',
        'level_required',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    public function questions()
    {
        return $this->belongsTo(Question::class, 'game_id', 'game_id');
    }
}

