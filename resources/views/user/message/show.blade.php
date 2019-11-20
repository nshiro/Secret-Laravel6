@extends('layouts.user')

@section('title', 'メッセージ詳細')

@section('content')

<h1>メッセージ詳細</h1>

<h2>{{ $message->title }}</h2>

<p>{!! nl2br(e($message->content)) !!}</p>

@stop