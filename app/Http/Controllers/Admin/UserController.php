<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ユーザー一覧
     */
    public function index(Request $request)
    {
        $users = User::latest()->withCount('messages')->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * ユーザーの削除
     */
    public function destroy(User $user)
    {
        $user->delete();

        return ['success' => true];
    }
}
