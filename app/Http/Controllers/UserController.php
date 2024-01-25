<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function addUserData(Request $request)
    {
        $user = auth()->user();


        if ($request->hasFile('profile_picture')) {

            $request->validate([
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->update(['profile_picture' => $imagePath]);
        }

        $user->update([
            'phonenumber' => $request->input('phonenumber'),
            'dob' => $request->input('dob'),
            'department' => $request->input('department'),
            'status' => $request->input('status'),
            'gender' => $request->input('gender'),
        ]);

        return response()->json(['message' => 'User data added successfully']);
    }
    public function getUsers()
    {
        session()->put('key', 'value');

        $users = User::all();

        return response()->json($users);
    }
    public function getUserData()
    {
        $user = auth()->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'phonenumber' => $user->phonenumber,
            'department' => $user->department,
            'dob' => $user->dob,
            'status' => $user->status,
            'gender' => $user->gender,

        ]);
    }
    public function getUserDetails(Request $request)
    {

        if (Auth::check()) {
           
            $user = Auth::user();
            return response()->json(['email' => $user->email, 'name' =>$user->name]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function showUserDetails()
    {
        return view('userDetails');
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'logged out'
        ];

        return response($response, 200);
    }

}
