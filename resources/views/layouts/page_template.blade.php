{{-- 親テンプレート --}}
{{-- resources/views/layouts/greeting.blade.php --}}
@include('tmp.header')


 
 
<div class="container">
 
 
<!--<h2>@yield('title')</h2>-->
 
 
@yield('content')
</div>
 
 
<!-- /container -->
 
<!-- jQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- BootstrapのJS読み込み -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>