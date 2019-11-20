@extends('layouts.admin')

@section('content')

<h1>メッセージ一覧</h1>

<p><a href="{{ route('admin.message.create') }}">新規作成へ</a></p>

<table border="1">
    <tr>
        <td>変更</td>
        <td>誰宛</td>
        <td>タイトル</td>
        <td>本文</td>
    </tr>
@foreach($messages as $message)
    <tr>
        <td><a href="{{ route('admin.message.edit', $message->id) }}">変更</a></td>
        <td>{{ $message->user->name }}</td>
        <td>{{ $message->title }}</td>
        <td>{{ Str::limit($message->content, 50) }}</td>
    </tr>
@endforeach
</table>

@stop