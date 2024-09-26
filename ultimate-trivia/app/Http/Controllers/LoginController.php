<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function insertUsers(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'level_id' => 'required|integer|in:1,2,3,4',
            'email' => 'required|string',
            'password' => 'required|string',
            'username' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new Login();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->level_id = $request->input('level_id');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_pictures'), $filename);
            $user->profile_picture = 'uploads/profile_pictures/' . $filename; // Save path in DB
        }

        $user->save();

        return response()->json("Data inserted");
    }

    public function getUsers()
    {
        $users = Login::all();

        return response()->json($users);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
    
}
