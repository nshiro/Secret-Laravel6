<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * 変更画面
     */
    public function edit()
    {
        $user = auth()->user();

        return view('user.profile.edit', compact('user'));
    }

    /**
     * 変更処理
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|max:255|email:filter|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($data);

        return redirect(route('user.profile.edit'))->with('status', '変更が完了しました');
    }
}
