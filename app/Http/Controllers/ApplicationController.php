<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function __invoke()
    {
        return view('admin.layouts.app');
    }

    public function getUserList()
    {
        return User::all();
    }
    public function createUser(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|unique:users,email',
        ]);

        try {
            $result = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
        } catch (Exception $e) {
            Log::error($e);
            return $e;
            $result = false;
        }
        return $result;
    }
    public function updateUser(Request $request)
    {

        $email = $request->input('email');
        try {
            $result = User::where('email', $email)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),

            ]);
        } catch (Exception $e) {
            log::error($e);
            $result = false;
        }
        if ($result) {
            return response(['message' => 'updated'], 202);
        }
        return response(['message' => 'not acceptable'], 406);
    }
}
