<!--***全てのページの雛形となるテンプレートです***-->

@include('tmp.header')


    <div id="fixedMessage" class="el_fixedMessage">情報を更新しました。</div>
    <div id="app">
        @yield('content')
    </div>



    <!-- Scripts -->

    <!--<script src="{{ asset('js/myscript.js') }}"></script>-->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
