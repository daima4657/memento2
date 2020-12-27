@extends('layouts.page_template')
@section('title', ' | MEMENTOについて')
@section('slug', 'about')
@section('content')

	<main>
		<div class="bl_pageHero">
			<h2 class="bl_pageHero_catch">About Memento</h2>
		</div>
		<section class="p-about">

			<!--<div class="bl_secCatch">
				<h3 class="op_main">What is Memento?</h3>
				<div class="op_sub">Mementoとは？</div>
			</div>-->

			<div class="p-about__main">
				<div class="p-about__inner">
					<div class="bl_sec1">
						<div class="bl_sec1_img">
							<img src="{{ asset('image/about_img01.jpg') }}" alt="">
						</div>
						<div class="bl_sec1_texts">
							<p>Mementoはあなたの代わりにあなたの記憶を管理し、美しく効率的に整理するためのツールです。</p>
							<p>誰でも無料で、アカウントを登録すればすぐに利用を開始することが可能です。</p>
						</div>
					</div>
					<div class="bl_sec2">
						<div class="bl_sec2_ttl">
							<h3 class="op_main">
								How to use
							</h3>
							<div class="op_sub">使い方</div>
						</div>
						<div class="bl_sec2_texts">
							<a href="">-アカウントの登録方法</a><br>
							<a href="">-データの追加方法</a>
						</div>
					</div>
					<div class="bl_sec2">
						<div class="bl_sec2_ttl">
							<h3 class="op_main">
								Developper
							</h3>
							<div class="op_sub">運営者情報</div>
						</div>
						<div class="bl_sec2_texts">
							当サービスに関するご質問は以下のサイトのお問い合わせフォームよりお願いします。
							<a href="https://spreadsheep.net/" target="_blank">https://spreadsheep.net/</a>
						</div>
					</div>
					<div class="bl_sec2">
						<div class="bl_sec2_ttl">
							<h3 class="op_main">
								FAQ
							</h3>
							<div class="op_sub">よくある質問</div>
						</div>
						<div class="bl_sec2_texts">
							準備中
						</div>
					</div>
				</div>
			</div>
			
		</section>
	</main>
@endsection