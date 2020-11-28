<?php
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

.bl_contentBlock{
    padding: 40px 0;
}

.el_greetingMessage{
    margin-bottom: 40px;
}

@media screen and (max-width: 840px){
  .el_greetingMessage{
    margin-bottom: 60px;
  }
}

.bl_navBlock_inner{
  padding: 20px 0px 20px 20px;
  box-sizing: border-box;
}

.bl_navBlock_ttl{
  font-size: 22px;
  font-weight: bold;
  margin-bottom: 20px;
  background-color: #fff;
  padding: 15px 15px 15px 15px;
  box-sizing: border-box;
  /*text-align: right;*/
}

.bl_navBlock_img{
  margin-bottom: 20px;
}

.bl_navBlock_data{
  margin-bottom: 20px;
}

.bl_navBlock_texts{
  background-color: #fff;
  padding: 15px 15px 15px 15px;
  box-sizing: border-box;
  text-align: left;
}

.bl_navBlock_data_lastupdate{
  font-size: 12px;
}

.bl_navBlock_texts_review_ttl{
  font-size: 16px;
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 1px #ccc dashed;
}

.bl_navBlock_texts_review_text{
  font-size :13px;
  letter-spacing: 0.1em
}

</style>

<?php 
$user = Auth::user();
$id = Auth::id();
?>

@extends('layouts.app')

@section('content')



<div class="bl_navBlock" data-id="1">
  <form id="updateDataForm" class="" method="post" name="form-update" enctype='multipart/form-data' class="form-update" role="form" action="/ajaxupdate">
    <div class="bl_navBlock_inner">
      <input id="detail-id" name="user_id" type="number" value="1">
      <div class="bl_navBlock_ttl">
        Title
        <input id="detail-ttl" type="text" name="title" class="form-control" placeholder="タイトルが入ります" required autofocus>
      </div>

      <div class="bl_navBlock_img">

        <!--<div id="detail-img" class="bl_navBlock_img_wrapper" style="background-image:url(store/image);">
          
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


      <div class="bl_navBlock_texts">
        <div class="bl_navBlock_texts_review">
          <div class="bl_navBlock_texts_review_ttl">
            Memo
          </div>
          <div class="bl_navBlock_texts_review_text">
            <textarea id="detail-desc" type="text" name="memo" class="form-control" placeholder="レビューなどが入ります" required autofocus></textarea>
          </div>
        </div>
      </div>

      <div class="bl_navBlock_data">
        <div class="bl_navBlock_data_lastupdate">最終更新日 : <span class="bl_navBlock_data_lastupdate_date"></span></div>
      </div>

      <div class="bl_toggleBlock_ttl op_side js_ajaxUpdate">更新</div>
      
    </div>
  </form>
</div>

<div class="container bl_contentBlock">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="bl_panelBlock">

                    <div class="el_greetingMessage">こんにちは<span style="color:green;font-weight: bold;"><?php echo $user->name; ?></span>さん！</div>
                    <div class="bl_tableBlock">

                        <div class="bl_tableBlock_ttl">あなたが最近読んだ本の記録</div>

                        <div id="users_list_book" class="bl_tableBlock_wrapper users_list_book__cell">

                            <?php
                            
                            $loop_limit = count($books);
                            for($i = 0; $i < $loop_limit; $i++){
                              $image = $books[$i]->image_path == "notset" ? "image/noimage.jpg" : "https://daima-test.s3-ap-northeast-1.amazonaws.com/bookimage/".$books[$i]->image_path;

                              echo <<< EOT
                              <div class="bl_tableBlock_tr" data-id="{$books[$i]->id}">
                              <div class="bl_tableBlock_tr_wrapper js_navButton">
                              <div class="bl_tableBlock_image">
                                <div class="bl_tableBlock_image_wrapper" style="background-image:url('{$image}');"></div>

                              </div>
                              <div class="bl_tableBlock_th">{$books[$i]->title}</div>
                              <div class="bl_tableBlock_td">{$books[$i]->memo}</div>
                              </div>
                              EOT;?>

                            <form method="post" name="form1" action="/result-delete">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="id" value="<?php echo $books[$i]->id; ?>">
                                <div class="el_deleteButton js_ajaxDelete" data-id="<?php echo $books[$i]->id; ?>">削除</div>
                                <!--<button class="el_deleteButton" href="javascript:form1.submit()">削除</button>-->
                            </form>

                             <?php
                             echo '</div>';
                            }
                            ?>

                        </div>

                            <div class="bl_tableBlock_tr bl_tableBlock_tr__toggle">

                              <div class="bl_toggleBlock">
                                <div class="bl_toggleBlock_ttl js_toggleOpen">
                                  <div class="el_toggleButton"></div>記録を追加する
                                </div>
                                <div class="bl_toggleBlock_content js_toggleContent">
                                  <!--<form class="form-signin" role="form" method="post" action="/console/response">-->
                                  <form id="createDataForm" enctype='multipart/form-data' class="form-signin" role="form" method="post" action="/ajaxbookadd">
                                  {{-- CSRF対策 --}}
                                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                                  <div class="bl_formBlock">
                                    <div class="bl_formBlock_item">
                                      <input id="input-book-ttl" type="text" name="title" class="form-control" placeholder="本のタイトルを入力してください" required autofocus>
                                    </div>
                                    <div class="bl_formBlock_item">
                                      <textarea id="input-book-review" name="memo" rows="4" cols="40" class="form-control" placeholder="感想など記入してください" required autofocus></textarea>
                                    </div>

                                    <div class="bl_formBlock_item">
                                      <!--<input id="input-book-image" type="file" name="book-create-image">-->
                                      <div id="dropzone" class="bl_imageDrop">
                                        <div class="bl_imageDrop_wrapper">
                                          <i class="far fa-images bl_imageDrop_icon"></i>
                                          <!--本のイメージ画像を設定してください<br>(ドラッグ＆ドロップ可)-->
                                        </div>
                                        <input id="input-book-image" type="file" name="book-create-image" accept="image/jpeg, image/png, application/pdf" />
                                      </div>

                                    </div>

                                    <div class="bl_toggleBlock_ttl js_ajaxButton">送信する</div><!--ajaxで送信-->
                                    <input type="submit" value="送信する">
                                    <!--<input type="submit" value="更新する">-->

                                    <!--<button class="btn btn-lg btn-primary btn-block" type="submit">送信</button>-->
                                  </div>
                                  
                                  </form>
                                  <input id="hoge" type="hidden" value="hoge">
                                </div>
                              </div>


                            </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
