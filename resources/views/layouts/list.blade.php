
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








	<!--dashboard only-->

	<div class="p-docs">

		<div class="p-docs__inner">
			<div class="p-section_ttl">
				<div class="p-section_ttl__main">
					Your Showcases
				</div>
				<div class="p-section_ttl__sub">
					あなたのショーケース
				</div>
			</div>
			<div id="showcase_view" class="p-docs__wrapper">
				<?php
				
				$loop_limit = count($showcases);
				for($i = 0; $i < $loop_limit; $i++){
					echo <<< EOT
					<div class="p-docs__item">
						<a href="/users/{$showcases[$i]->user_id}/{$showcases[$i]->name}" class="u-cover"></a>
						{$showcases[$i]->name}
						<div class="p-docs_item_overflow">
							<div class="p-three_dots">
								<span class="__dot"></span><span class="__dot"></span><span class="__dot"></span>
							</div>
						</div>
						<div class="p-docs__menu">
							<div class="p-docs__menu__item">
								<span class="js-ajax_delete_showcase" data-id="{$showcases[$i]->id}">ショーケースを削除する</span>
							</div>
						</div>
					</div>
					EOT;
					}
					?>

			</div>
		</div>
		
	</div>
	<!--END:dashboard only-->








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
