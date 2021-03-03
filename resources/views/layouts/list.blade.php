
<?php
/*
Template Name : Listテンプレート
Tamplate location : layouts/list.blade.php
*/

/*session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/dbconnect/dbconnect.php';
//require_once dirname(__FILE__) . "/dbconnect.php";
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
}

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";
$result = $mysqli->query($query);

$result = $mysqli->query($query);
if (!$result) {
	print('クエリーが失敗しました。' . $mysqli->error);
	$mysqli->close();
	exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
	$username = $row['name'];
	$email = $row['email'];
}

// データベースの切断
$result->close();*/
?>

<style>



</style>

<?php 
$user = Auth::user();
$id = Auth::id();
?>

@extends('layouts.app')
@section('content')



<div class="p-side_area __edit" data-id="1">
	<form id="updateDataForm" class="" method="post" name="form-update" enctype='multipart/form-data' class="form-update" role="form" action="/ajaxupdate">
		<div class="p-side_area__inner">
			<input id="detail-id" name="user_id" type="number" value="1">
			<div class="p-side_area__role">
				Edit your item
			</div>

			<div class="p-side_area__item __date">
				<div class="p-side_area__data__lastupdate">最終更新日 : <span class="p-side_area__data__lastupdate__date"></span></div>
			</div>
			<div class="p-side_area__item __ttl">
				<div class="p-side_area__item__text">
					Title
				</div>
				
				<input id="detail-ttl" type="text" name="title" class="form-control" placeholder="タイトルが入ります" required autofocus>
			</div>

			<div class="p-side_area__item __img">

				<div class="p-side_area__item__text">
					Thumbnail
				</div>
				<!--<div id="detail-img" class="p-side_area__img_wrapper" style="background-image:url(store/image);">
					
				</div>-->

				<div id="dropzone2" class="bl_imageDrop">
					<div class="bl_imageDrop_wrapper">
						<i class="far fa-images bl_imageDrop_icon"></i>
						<!--本のイメージ画像を設定してください<br>(ドラッグ＆ドロップ可)-->
					</div>
					<input id="update-book-image" type="file" name="book-update-image" accept="image/jpeg, image/png, application/pdf" />
				</div>

				<!--<input id="update-book-image" type="file" name="book-update-image">-->

			</div>


			<div class="p-side_area__item __memo">
				<div class="p-side_area__texts__review">
					<div class="p-side_area__item__text">
						MEMO
					</div>
					<div class="p-side_area__texts__review__text">
						<textarea id="detail-desc" type="text" name="memo" class="form-control" placeholder="レビューなどが入ります" required autofocus></textarea>
					</div>
				</div>
			</div>

			@if ($__env->yieldContent('slug') === 'dashboard')
			<div class="p-button op_side js-ajaxUpdate">Update</div>
			@endif
			
		</div>
	</form>
</div>

<!--新規アイテム追加-->
<div class="p-side_area __add">
	<div class="p-side_area__inner">
		<div class="p-toggle">
			<!--<div class="p-button js-toggle_open">
				<div class="el_toggleButton"></div>記録を追加する
			</div>-->
			<div class="p-toggle_content ">
				<!--<form class="form-signin" role="form" method="post" action="/console/response">-->
				<form id="createDataForm" enctype='multipart/form-data' class="form-signin" role="form" method="post" action="/ajaxbookadd">
				{{-- CSRF対策 --}}
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="bl_formBlock">
					<div class="p-side_area__role">
						Add new item
					</div>

					<div class="p-side_area__item __ttl">
						<div class="p-side_area__item__text">
							Title
						</div>
						
						<input id="input-book-ttl" type="text" name="title" class="form-control" placeholder="本のタイトルを入力してください" required autofocus>
					</div>


					<div class="p-side_area__item __memo">
						<div class="p-side_area__item__text">
							Description
						</div>
						
						<textarea id="input-book-review" name="memo" rows="4" cols="40" class="form-control --textarea" placeholder="感想など記入してください" required autofocus></textarea>
					</div>

					<div class="p-side_area__item __memo">
						<div class="p-side_area__item__text">
							Thumbnail
						</div>
						
						<div id="dropzone" class="bl_imageDrop">
							<div class="bl_imageDrop_wrapper">
								<i class="far fa-images bl_imageDrop_icon"></i>
								<!--本のイメージ画像を設定してください<br>(ドラッグ＆ドロップ可)-->
							</div>
							<input id="input-book-image" type="file" name="book-create-image" accept="image/jpeg, image/png, application/pdf" />
						</div>
					</div>


					@if ($__env->yieldContent('slug') === 'dashboard')
					<div class="p-button js-ajax_button">Apply</div><!--ajaxで送信-->
					@endif
					<!--<input type="submit" value="送信する">-->
					<!--<input type="submit" value="更新する">-->

					<!--<button class="btn btn-lg btn-primary btn-block" type="submit">送信</button>-->
				</div>
				
				</form>
				<input id="hoge" type="hidden" value="hoge">
			</div>
		</div>
	</div>
</div>



<main class="p-main">
	<div class="p-left">
		@if ($__env->yieldContent('slug') === 'dashboard')
		<div class="p-add js-open_add_item"></div>
		@endif
	</div>
	<div class="p-dash_main">
		<div class="p-dash_main__inner">
				<div class="p-pannel_block">

						<div class="p-pannel_block__heading">
							@if(isset( $page_title ))
							<div class="p-pannel_block__heading_ttl">
								{{$page_title}}
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
</main>


<!--<div id="muuri_button">整列</div>
<div id="muuri_button_ref">高さ</div>-->


<!--<h1 id ="hogege">Grid Layout by Muuri.js</h1>-->
<!--<div class="loading">
	Loading images...
</div>
<div class="grid">
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/195/400/any?1" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/400/195/any?2" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/195/400/any?3" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/400/195/any?4" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/195/400/any?5" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/400/195/any?6" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/195/400/any?7" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/400/195/any?8" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/195/400/any?9" />
		</div>
	</div>
	<div class="item">
		<div class="item-content">
			<img src="https://placeimg.com/400/195/any?10" />
		</div>
	</div>
</div>-->



<!--<ul id="items">
	<li>item 1</li>
	<li>item 2</li>
	<li>item 3</li>
</ul>

<div class="card-body pt-0 pb-2 pl-3">
		<div class="card-text">
			<sample-like>
			</sample-like>
		</div>
	</div>

			<bookcell>
			</bookcell>-->

@endsection
