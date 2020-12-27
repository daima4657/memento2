@extends('layouts.app')

@section('content')
<main class="p-main --reset">
  <div class="p-login">
    <div class="p-login__inner u-inner">

      <div class="p-login__wrapper">
        <div class="p-login__heading">
          <h2 class="p-sec_ttl">
            パスワードリセット
          </h2>
        </div>
        <form class="p-login_form" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

          <div class="p-login_form__tr --mail">

            <div class="p-form_group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="email" class="p-form_group__label">メールアドレス</label>

              <div class="p-form_group__content">

                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

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


          <div class="p-login_form__tr --confirm">

            <div class="p-form_group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label for="password-confirm" class="p-form_group__label">パスワード(確認)</label>

              <div class="p-form_group__content">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>


          <div class="p-login_form__tr --send">

            <div class="p-form_group">
              <label for="" class="p-form_group__label"></label>
              <div class="p-form_group__content">
                <button type="submit" class="btn btn-primary">
                    パスワードリセット
                </button>
              </div>
            </div>
          </div>


        </form>
      </div>
      
    </div>
  </div>
</main>


<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
