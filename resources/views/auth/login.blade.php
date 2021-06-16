

@php
$title = 'Login';
@endphp
@extends('layouts.app')

@section('content')
<main class="p-main --login">
  <div class="p-login">
    <div class="p-login__inner u-inner">

      <div class="p-login__wrapper">
        <div class="p-login__heading">
          <h2 class="p-sec_ttl">
            Login
          </h2>
        </div>
        <form class="p-login_form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

          <div class="p-login_form__tr --mail">

            <div class="p-form_group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="p-form_group__label">メールアドレス</label>

              <div class="p-form_group__content">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>


          <div class="p-login_form__tr --pass">

            <div class="p-form_group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="p-form_group__label">パスワード</label>

              <div class="p-form_group__content">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>


          <div class="p-login_form__tr --checkbox">

            <div class="p-form_group">
              <label for="" class="p-form_group__label"></label>
              <div class="p-form_group__content">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ログイン情報を記憶する
                  </label>
                </div>
              </div>
            </div>
          </div>


          <div class="p-login_form__tr --send">

            <div class="p-form_group">
              <label for="" class="p-form_group__label"></label>
              <div class="p-form_group__content">
                <button type="submit" class="btn btn-primary">
                  ログイン
                </button>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                  パスワードを忘れた場合は?
                </a>
              </div>
            </div>
          </div>


        </form>
      </div>
      
    </div>
  </div>
</main>

@endsection
