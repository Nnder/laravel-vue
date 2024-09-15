<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'name' => ['required'],
        ]);


        $user = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:6'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user['password']))
            return response()->json(['error' => 'Invalid credentials'], 401);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        // $data = $request->validate([
        //     'email' => ['required', 'email', 'exists:users'],
        //     'password' => ['required', 'min:6'],
        // ]);

        // $user = User::where('email', $data['email'])->first();

        // if (!$user || !Hash::check($data['password'], $user['password']))
        //     return response()->json(['error' => 'Invalid credentials'], 401);

        // $token = $user->createToken('auth_token')->plainTextToken;

        // return [
        //     'user' => $user,
        //     'token' => $token,
        // ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
