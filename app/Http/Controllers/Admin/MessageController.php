<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * メッセージ一覧
     */
    public function index()
    {
        $messages = Message::latest()->with('user')->get();

        return view('admin.message.index', compact('messages'));
    }

    /**
     * 新規作成画面
     */
    public function create(Message $message)
    {
        $userlist = User::getUserList();

        return view('admin.message.create', compact('message', 'userlist'));
    }

    /**
     * 新規登録処理
     */
    public function store(SaveMessage $request, Message $message)
    {
        $data = $request->validated();

        $message->fill($data)->save();

        return redirect(route('admin.message.edit', $message))->with('status', '登録が完了しました');
    }

    /**
     * 変更画面
     */
    public function edit(Message $message)
    {
        $userlist = User::getUserList();

        return view('admin.message.create', compact('message', 'userlist'));
    }

    /**
     * 変更処理
     */
    public function update(SaveMessage $request, Message $message)
    {
        $data = $request->validated();

        $message->fill($data)->save();

        return redirect(route('admin.message.edit', $message))->with('status', '変更が完了しました');
    }
}
