{{-- 子テンプレート --}}
{{-- resources/views/pages/register.blade.php --}}
@extends('layouts.greeting')
@section('title', 'ログインページ')
@section('content')
 
 
{{$message}}
 
 
 
<form class="form-signin" role="form" method="post" action="register/response">
{{-- CSRF対策 --}}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="text" name="name" class="form-control" placeholder="名前を文字を入力してください" required autofocus>
<input type="password" name="password" class="form-control" placeholder="パスワードを入力してください" required autofocus>
<button class="btn btn-lg btn-primary btn-block" type="submit">送信</button>
</form>
 
 
@endsection