{{-- 子テンプレート --}}
{{-- resources/views/pages/result.blade.php --}}
@extends('layouts.greeting')
@section('title', 'データベース登録完了ページ')
@section('content')
 
 
{{$message}}
 
 <a href="{{ url('/home') }}">homeへ戻る</a>
 
<!--<div class="bl_registerCompleteBlock">
	登録完了しました!
</div>-->
 
 
@endsection