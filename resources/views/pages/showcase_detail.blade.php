
<?php
/*
Template Name : Listテンプレート
Tamplate location : pages/list.blade.php
*/
?>

<style>



</style>


@php
$user_name = Auth::user();
$user = Auth::user();
$id = Auth::id();
$title = $user->name.'さんのショーケース | ';
$page_title = "Showcase";
$slug = "showcase_detail";
@endphp


<?php 
$user = Auth::user();
$id = Auth::id();
?>

@extends('layouts.app')
@section('content')













	<div class="p-dash_main">
		<div class="p-dash_main__inner">
				<div class="p-pannel_block">

						<div class="p-pannel_block__heading">
							@if(isset( $showcase_title ))
							<div class="p-pannel_block__heading_ttl">
								{{$showcase_title}}
							</div>
							@endif
							@if ($slug === 'dashboard')
								<div class="p-greeting">Hello！<span style="color:green;font-weight: bold;"><?php echo $user->name; ?></span></div>
							@elseif ($slug === 'list')
								<div class="p-greeting"><span style="color:green;font-weight: bold;"><?php echo $user->name; ?></span>さんのショーケース</div>
							@endif
							
						</div>
						
						@include('tmp.item_list')


				</div>
			
		</div>
	</div>

@endsection

