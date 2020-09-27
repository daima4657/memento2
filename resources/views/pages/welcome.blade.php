@section('slug', 'home')
@include('tmp.header')

        <!-- Styles -->
        <style>
            /*@import url('https://fonts.googleapis.com/css?family=Abel');*/

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding: 40px 0 80px;
                box-sizing: border-box;
            }

            .title {
                font-size: 84px;
                margin-bottom: 80px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .el_indexHeroText{
                position: relative;
                font-size: 60px;
                color: #1a3144;
                letter-spacing: 0.1em;
                margin-bottom: 30px;
                font-family: 'Abel', sans-serif;
                font-weight: bold;
            }
            .el_indexHeroText:after{
                content:"";
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                bottom: -10px;
                width: 40px;
                height: 1px;
                background-color: #1a3144;
            }
            .el_indexHeroSubText{
                font-size: 16px;
                letter-spacing: 0.2em;
                margin: 0;
                color: #1a3144;
            }
            .el_indexHeroLogo{
                display: inline-block;
                margin: 30px 0 80px;
                width: 100%;
                max-width: 180px;
            }
        </style>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <!--<a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>-->
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title">
                    <img src="/image/mement_logo.svg" class="el_indexHeroLogo">
                    <div class="el_indexHeroText">MEMENTO</div>
                    <p class="el_indexHeroSubText">keep your memory</p>
                </div>

                <div class="links">
                    <a href="http://spreadsheep.net/">Developper</a>
                    <!--<a href="/console">Console</a>-->
                    <!--<a href="https://laracasts.com">Laracasts</a>-->
                    <a href="{{ url('/about') }}">About memento</a>
                    <!--<a href="https://forge.laravel.com">Forge</a>-->
                    <a href="https://github.com/daima4657/memento">GitHub</a>
                </div>
            </div>
        </div>
        <!--<div class="bl_introBlock">TEST</div>-->
        <!--<div id="app">
          <sample1>
              
          </sample1>
        </div>-->
        
        <script src="{{ mix('/js/app.js')  }}"></script>
    </body>
</html>
