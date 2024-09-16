<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VueApiController extends Controller
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

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = User::where('email', $data['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        return response()->json(['ok' => 'session removed'], 200);
    }

    public function uploadAvatar(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();

            $user = User::where('email', $data['email'])->first();

            $avatar->move(public_path('images/avatars'), $avatarName);

            $user->avatar = 'images/avatars/' . $avatarName;
            $newAvatar = $user->avatar;
            $user->save();

            return response()->json(['url' => $newAvatar] , 200);
        }

        return [
            'error' => 'Ошибка загрузки картинки'
        ];
    }

    public function getUser(Request $request)
    {
        // $user = User::where('token', $request['token'])->first();
        // $user = $request->user();
        $user = Auth::user();
        return response()->json($user);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
