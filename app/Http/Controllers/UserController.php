<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);

        // return redirect()->route('home')->with('token', $token);
        return redirect('/');
    }

    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = User::where('email', $data['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect()->route('home')->with('token', $token);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);


        // $data = $request->validate([
        //     'email' => ['required', 'email', 'exists:users'],
        //     'password' => ['required', 'min:6'],
        // ]);

        // $user = User::where('email', $data['email'])->first();

        // if (!$user || !Hash::check($data['password'], $user['password']))
        //     return response()->json(['error' => 'Invalid credentials'], 401);


        // Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        // $token = $user->createToken('auth_token')->plainTextToken;

        // return to_route('home', ['token' => $token]);

        // ->with('token', $token);

        // return response()->json([
        //     'message' => 'Login successful',
        //     'user' => $user,
        //     'token' => $token,
        // ]);

        // return redirect()->route('home')->with([
        //     'user' => $user,
        //     'token' => $token,
        // ]);

    }


    public function logout(Request $request)
    {

        $request->session()->invalidate();
        return to_route('home');

        //     $token = $request->user()->currentAccessToken();

        // return response()->json(['error' => 'No active token found'], 400);

        // $request->user()->tokens()->delete();

        // // Auth::logout();
        // // $request->user()->currentAccessToken()->delete();


        // return to_route('home', ['token' => null]);

        // Auth::logout();
        // $request->session()->invalidate();

        // $token = $request->user()->currentAccessToken();

        // if ($token) {
        //     $token->delete();
        //     return response()->json(['message' => 'Successfully logged out']);
        // }

        // return response()->json(['message' => 'No active token found'], 400);

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
