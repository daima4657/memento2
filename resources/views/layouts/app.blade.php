<!--***全てのページの雛形となるテンプレートです***-->
<!--Template name : app.blade-->
@include('tmp.header')

@include('tmp.pinned_register')

<main class="p-main" v-cloak>

    <div id="fixedMessage" class="el_fixedMessage">情報を更新しました。</div>
    <div id="app">
        @yield('content')
    </div>


    <!-- Scripts -->
</main>
    <!--<script src="{{ asset('js/myscript.js') }}"></script>-->
    <script src="{{ mix('js/all.js') }}"></script>
</body>
</html>