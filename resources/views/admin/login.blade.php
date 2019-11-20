<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理者ログイン</title>
<link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>

<h2>管理者ログイン</h2>

<!-- エラー出力 -->
@if ($errors->any())
    <ul class="error-box">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="post">
@csrf

<ul>
    <li>
        <label>ログインID</label>
        <input type="text" name="username" value="{{ old('username') }}">
    </li>

    <li>
        <label>パスワード</label>
        <input type="password" name="password">
    </li>
</ul>

<input type="submit" value="ログイン">
</form>

</body>
</html>