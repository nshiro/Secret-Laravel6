<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>確認画面</title>
<link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>

<form method="post">
@csrf

<ul>
    <li>
        <label>名前</label>
        {{ $user->name }}
    </li>

    <li>
        <label>メールアドレス</label>
        {{ $user->email }}
    </li>

    <li>
        <label>パスワード</label>
        （表示されません）
    </li>

    <li>
        <label>入会理由</label>
        {{ $user->reason }}
    </li>
</ul>

<a href="{{ route('signup.index') }}">戻る</a>　<input type="submit" value="送信する">

</form>

</body>
</html>