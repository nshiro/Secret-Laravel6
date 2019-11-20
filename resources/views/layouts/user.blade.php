<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>@section('title')@show - サイト名</title>
<link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>

<p>ようこそ、{{ auth()->user()->name }}さん</p>

<ul>
    <li><a href="{{ route('user.top') }}">ユーザーTOP</a></li>
    <li><a href="{{ route('user.profile.edit') }}">登録情報変更</a></li>
    <li><a href="{{ route('user.message.index') }}">メッセージ一覧</a></li>
    <li><a href="{{ route('user.logout') }}">ログアウト</a></li>
</ul>

@yield('content')

</body>
</html>