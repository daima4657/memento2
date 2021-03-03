<!--登録したアイテムの一覧用テンプレート-->

						<div class="p-table_block">

								<!--<div class="p-table_block__ttl">あなたが最近読んだ本の記録</div>-->

								<div id="users_list_book" class="p-table_block__wrapper users_list_book__cell">

									<?php
									
									$loop_limit = count($books);
									for($i = 0; $i < $loop_limit; $i++){
										$image = $books[$i]->image_path == "notset" ? "image/noimage.jpg" : "https://daima-test.s3-ap-northeast-1.amazonaws.com/bookimage/".$books[$i]->image_path;

										echo <<< EOT
										<div class="p-table_block__tr --cell" data-id="{$books[$i]->id}">
										<div class="p-table_block__tr__wrapper js-nav_button">
										<div class="p-table_block__image">
											<div class="p-table_block__image__wrapper">
												<img src="{$image}">
											</div>
										</div>
										<div class="p-table_block__th">{$books[$i]->title}</div>
										<!--<div class="p-table_block__td">{$books[$i]->memo}</div>-->
										</div>
										EOT;?>


									@if ($__env->yieldContent('slug') === 'dashboard')
										<form method="post" name="form1" action="/result-delete">
												<input type="hidden" name="_token" value="{{csrf_token()}}">
												<input type="hidden" name="id" value="<?php echo $books[$i]->id; ?>">
												<div class="el_deleteButton js-ajax_delete" data-id="<?php echo $books[$i]->id; ?>"></div>
												<!--<button class="el_deleteButton" href="javascript:form1.submit()">削除</button>-->
										</form>
									@endif



									 <?php
									 echo '</div>';
									}
									?>

								</div>

										<div class="p-table_block__tr p-table_block__tr__toggle">




										</div>


						</div>
