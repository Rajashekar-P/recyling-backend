<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users
        ], 200);
    }

     public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'user' => $user
        ], 200);
    }

    // Update method for updating user name and email
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate the incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Update the user fields
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save(); // Save the updated user data to the database

        // Return the updated user data
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }
}
