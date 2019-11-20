<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理者</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link type="text/css" rel="stylesheet" href="/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<ul>
    <li><a href="/admin/user">ユーザー一覧</a></li>
    <li><a href="/admin/message">個別ユーザーへのメッセージ</a></li>
    <li><a href="{{ route('admin.logout') }}">ログアウト</a></li>
</ul>

@yield('content')

</body>
</html>
