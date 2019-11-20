@extends('layouts.user')

@section('title', 'メッセージ一覧')

@section('content')

<h1>自分宛のメッセージ一覧</h1>

<table border="1">
    <tr>
        <td>詳細</td>
        <td>登録日</td>
        <td>タイトル</td>
        <td>本文</td>
    </tr>
@foreach($messages as $message)
    <tr>
        <td><a href="{{ route('user.message.show', $message->id) }}">詳細へ</a></td>
        <td>{{ $message->created_at->format('Y年n月j日') }}</td>
        <td>{{ $message->title }}</td>
        <td>{{ Str::limit($message->content, 50) }}</td>
    </tr>
@endforeach
</table>

@stop