<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';
    protected $primaryKey = 'level_id';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['level_name', 'description'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'level_id');
    }
}
