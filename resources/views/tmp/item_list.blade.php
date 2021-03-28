<!--登録したアイテムの一覧用テンプレート-->

						<div class="p-table_block">

								<!--<div class="p-table_block__ttl">あなたが最近読んだ本の記録</div>-->

								<div id="users_list_book" class="p-table_block__wrapper users_list_book__cell">

									<?php
									
									$loop_limit = count($showcase_items);
									for($i = 0; $i < $loop_limit; $i++){
										$image = $showcase_items[$i]->image_path == "notset" ? "image/noimage.jpg" : "https://daima-test.s3-ap-northeast-1.amazonaws.com/bookimage/".$showcase_items[$i]->image_path;

										echo <<< EOT
										<div class="p-table_block__tr --cell" data-id="{$showcase_items[$i]->id}">
										<div class="p-table_block__tr__wrapper js-submenu_toggle" data-submenu_type="edit">
										<div class="p-table_block__image">
											<div class="p-table_block__image__wrapper">
												<img src="{$image}">
											</div>
										</div>
										<div class="p-table_block__th">{$showcase_items[$i]->title}</div>
										<!--<div class="p-table_block__td">{$showcase_items[$i]->memo}</div>-->
										</div>
										EOT;?>



										<form method="post" name="form1" action="/result-delete">
												<input type="hidden" name="_token" value="{{csrf_token()}}">
												<input type="hidden" name="id" value="<?php echo $showcase_items[$i]->id; ?>">
												<div class="el_deleteButton js-ajax_delete" data-id="<?php echo $showcase_items[$i]->id; ?>"></div>
												<!--<button class="el_deleteButton" href="javascript:form1.submit()">削除</button>-->
										</form>


									@if ($__env->yieldContent('slug') === 'dashboard')
									@endif



									 <?php
									 echo '</div>';
									}
									?>

								</div>

										<div class="p-table_block__tr p-table_block__tr__toggle">




										</div>


						</div>
