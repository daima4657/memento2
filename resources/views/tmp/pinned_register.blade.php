@isset($slug)
@if ($slug === 'dashboard')

<!--Submenu.-->
<div id="submenu" class="p-side_area __edit" data-id="1" data-type="new" v-cloak>

	<div class="p-side_area__wrapper __edit">
		<form id="updateDataForm" class="" method="post" name="form-update" enctype='multipart/form-data' class="form-update" role="form" action="/ajax_edit_showcase_item">
			<div class="p-side_area__inner">
				{{-- CSRF対策 --}}
				<input type="hidden" name="_token" value="{{csrf_token()}}">

				<input id="detail-id" name="user_id" type="number" value="1">
				<div class="p-side_area__role">
					Edit your item!
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




				<div class="p-button op_side js-ajaxUpdate">Update</div>

				
			</div>
		</form>
	</div>

	<div class="p-side_area__wrapper __new">
		<form id="createShowCaseForm" enctype='multipart/form-data' class="form-signin" role="form" method="post" action="/ajax_showcase_add">
			<div class="p-side_area__inner">
				{{-- CSRF対策 --}}
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="bl_formBlock">
					<div class="p-side_area__role">
						Add New Showcase 
					</div>

					<div class="p-side_area__item __ttl">
						<div class="p-side_area__item__text">
							Title
						</div>
						
						<input id="input-book-ttl" type="text" name="title" class="form-control" placeholder="作成するショーケースのタイトルを入力してください" required autofocus>
					</div>


					@if ($slug === 'dashboard')
					<div class="p-button js-create_showcase_button">Apply</div><!--ajaxで送信-->
					@endif
					<!--<input type="submit" value="送信する">-->
					<!--<input type="submit" value="更新する">-->

					<!--<button class="btn btn-lg btn-primary btn-block" type="submit">送信</button>-->
				</div>

			</div>
		
		</form>
	</div>

</div>

@elseif ($slug === 'showcase_detail')
<!--Submenu.-->
<div id="submenu" class="p-side_area __edit" data-id="1" data-type="new" v-cloak>

	<div class="p-side_area__wrapper __edit"><!--既存のアイテムを編集するためのボード-->
		<form id="updateDataForm" class="" method="post" name="form-update" enctype='multipart/form-data' class="form-update" role="form" action="/ajax_edit_showcase_item">
			<div class="p-side_area__inner">
				{{-- CSRF対策 --}}
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input id="edit-item-id" name="showcase_id" type="number" value="1">
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

				<div class="p-button op_side js-ajaxUpdate">Update</div>

				
			</div>
		</form>
	</div>

	<div class="p-side_area__wrapper __new">
		<form id="createDataForm" enctype='multipart/form-data' class="form-signin" role="form" method="post" action="/apply_new_item">
			<div class="p-side_area__inner">
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


					<div class="p-button js-ajax_button">Apply</div><!--ajaxで送信-->

					<!--<input type="submit" value="送信する">-->
					<!--<input type="submit" value="更新する">-->

					<!--<button class="btn btn-lg btn-primary btn-block" type="submit">送信</button>-->
				</div>

			</div>
		
		</form>
	</div>

</div>
@endif


@if ($slug === 'dashboard' || $slug === 'showcase_detail')
<!--新規アイテム追加ボタン-->
<div class="p-docs_add js-submenu_toggle" data-submenu_type="new"></div>
@endif
@endisset