@extends('layouts.app')

@section('content')
<main class="p-main --login">
  <div class="p-login">
    <div class="p-login__inner u-inner">

      <div class="p-login__wrapper">
        <div class="p-login__heading">
          <h2 class="p-sec_ttl">
            Register
          </h2>
        </div>
        <form class="p-login_form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

          <div class="p-login_form__tr --name">

            <div class="p-form_group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="p-form_group__label">ユーザー名</label>

              <div class="p-form_group__content">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>


          <div class="p-login_form__tr --mail">

            <div class="p-form_group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="p-form_group__label">メールアドレス</label>

              <div class="p-form_group__content">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>


          <div class="p-login_form__tr --mail">

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


          <div class="p-login_form__tr --mail">

            <div class="p-form_group">
              <label for="password-confirm" class="p-form_group__label">パスワード(確認)</label>

              <div class="p-form_group__content">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>
          </div>


          <div class="p-login_form__tr --send">

            <div class="p-form_group">
              <label for="" class="p-form_group__label"></label>
              <div class="p-form_group__content">
                <button type="submit" class="btn btn-primary">
                  登録
                </button>
              </div>
            </div>
          </div>


        </form>
      </div>
      
    </div>
  </div>
</main>

@endsection
