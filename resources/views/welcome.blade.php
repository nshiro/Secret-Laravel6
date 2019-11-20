<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>TOPページ</title>
<link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>

<h2>各ページへのリンク</h2>

<ul>
    <li>
        <a href="{{ route('signup.index') }}" target="_blank">ユーザー新規登録</a>
    </li>
    <li>
        <a href="{{ route('user.login') }}" target="_blank">ユーザーログイン</a>
    </li>
    <li>
        <a href="{{ route('admin.login') }}" target="_blank">管理者ログイン</a>
    </li>
</ul>

</body>
</html>