@extends('layouts.admin')

@section('content')

<h1>ユーザー一覧</h1>

<table border="1">
    <tr>
        <td>名前</td>
        <td>メールアドレス</td>
        <td>メッセージ数</td>
        <td>削除</td>
    </tr>
@foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->messages_count }}</td>
        <td><input type="button" class="del_btn" data-id="{{ $user->id }}" value="削除"></td>
    </tr>
@endforeach
</table>


<script>
// データの削除
jQuery(function ($) {

    /**
     * 削除用AJAX
     */
    function deleteRecord(url, btn) {
        $.ajax({
            url: url,
            data: {_method: "DELETE"},
            method: "post"
        }).done(function () {
            $(btn).closest("tr").remove();
        }).fail(function (xhr, str1, str2) {
            alert("データの削除に失敗しました");
        });
    }

    /**
     * 削除ボタンが押されたら、削除用AJAXを呼び出す
     */
    $("table").on("click", ".del_btn", function () {
        var url = "{{ route('admin.user.destroy', '') }}/" + $(this).data("id");

        deleteRecord(url, this);
    });

    // CSRFトークンの設定
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>

@stop