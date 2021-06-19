@section('slug', 'home')
@include('tmp.header')

<main class="p-main">

        <!-- Styles -->
        <style>
            /*@import url('https://fonts.googleapis.com/css?family=Abel');*/


            
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

</main>

    </body>
</html>
