<?php

namespace App\Http\Controllers;

use App\Models\Playtimes;
use Illuminate\Http\Request;

class PlaytimesController extends Controller
{
    public function getUserPlaytime(Request $request)
    {
        $userId = $request->query('user_id');

        if ($userId) {
            $playtimeData = Playtimes::where('user_id', $userId)->get();

        
            return response()->json($playtimeData);
        } else {
            return response()->json(['error' => 'user_id not provided'], 400);
        }
    }

}
