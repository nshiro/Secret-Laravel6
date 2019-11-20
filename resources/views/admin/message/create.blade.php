@extends('layouts.admin')

@section('content')

<h1>メッセージ{{ ($message->exists) ? '変更': '登録' }}</h1>

<!-- エラーメッセージ -->
@if ($errors->any())
    <ul class="error-box">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<!-- 成功時のメッセージ -->
@if (session('status'))
    <p class="info-box">{{ session('status') }}</p>
@endif

<form method="post">
@csrf

<ul>
    <li>
        <label>誰宛</label>
        <select name="user_id">
            <option value="">選択して下さい</option>
            @foreach($userlist as $key => $val)
                <option value="{{ $key }}" @if (old('user_id', $message->user_id) == $key) selected @endif>{{ $val }}</option>
            @endforeach
        </select>
    </li>

    <li>
        <label>タイトル</label>
        <input type="text" name="title" size="50" value="{{ old('title', $message->title) }}">
    </li>

    <li>
        <label>本文</label>
        <textarea name="content" cols="60" rows="10">{{ old('content', $message->content) }}</textarea>
    </li>
</ul>

<input type="submit" value="{{ ($message->exists) ? '変更する': '登録する' }}">
</form>

@stop