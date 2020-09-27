{{-- 子テンプレート --}}
{{-- resources/views/pages/register.blade.php --}}
@extends('layouts.greeting')
@section('title', '情報記憶ページ')
@section('content')
 

<?php 
$user = Auth::user();
$id = Auth::id();
?>
 
{{$message}}
 
<form class="form-signin" role="form" method="post" action="/console/response">
{{-- CSRF対策 --}}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="text" name="title" class="form-control" placeholder="本のタイトルを入力してください" required autofocus>
<input type="text" name="memo" class="form-control" placeholder="感想など" required autofocus>
<button class="btn btn-lg btn-primary btn-block" type="submit">送信</button>
</form>
 
 
@endsection