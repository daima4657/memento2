<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//タイムゾーンを日本にあわせる
date_default_timezone_set('Asia/Tokyo');

class FormController extends Controller {

  #registerページの表示
  public function register()
  {
   return view('pages.register', ['message' => 'Console']);
  }

  #値を受けて保存
  public function consoleResponse(Request $request)
  {
  /*
  * バリデーション
  */
  /*$this->validate($request, [
  'name' => 'required',
  ]);*/
 
  /*
  * 新しいレコードの追加
  */
  #Bookモデルクラスのオブジェクトを作成
  $book = new Book();
 
  #Bookモデルクラスのプロパティに値を代入
  $book->title = $request->input('title');
  $book->memo = $request->input('memo');
  $book->userid = Auth::id();// 現在認証されているユーザーの代入
  #Bookモデルクラスのsaveメソッドを実行
  $book->save();
 
  /*
  * View表示
  */
  #変数に代入
  //$res = "こんにちは！" . $request->input('onamae')."さん！！";
 
    #Viewメソッドに引数を指定して返す
    return view('pages.result', ['message' => '登録ありがとうございます!'.$request->input('name').'さん']);
  }


  #bookの登録を削除してリザルトページへ移行
  public function deleteResponse(Request $request)
  {
 
  /*
  * 指定されたレコードの削除
  */
  
  #Bookモデルクラスのオブジェクトを作成

  $book = Book::findOrFail($request->input('id'));
 
  $book->delete();
 
    #Viewメソッドに引数を指定して返す
    return view('pages.result', ['message' => 'データの削除を完了しました!']);
  }


  #ログインページの表示
  public function login()
  {
   return view('pages.login', ['message' => 'ログイン情報を入力してください']);
  }

  #getでconsoleにアクセスした時の処理
  public function getConsole() {return view('pages.console', ['message' => '登録情報を入力してください']);
  }
 
  #postでgreeting/indexにアクセスしたときの処理
  public function postIndex(Request $request)
  {
  $res = "こんにちは！" . $request->input('onamae')."さん！！";
  return view('greeting', ['message' => $res]);
  }


  #ajaxでbookの情報を取得
  public function bookGetAjaxById(){


      #Bookモデルクラスのオブジェクトを作成
      $book = new Book();

      //DBdataを取得
      $books = Book::where('id', $_POST['id'])->get();
      $books[0]['last_update_date'] = date('Y.m.d h:i:s', strtotime($books[0]['updated_at']));
      $books->toJSON();
      return response()->json(
              [
                  $books
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }


  #ajaxでbookの情報を追加
  public function bookAddAjax(Request $request){


      #Bookモデルクラスのオブジェクトを作成
      $book = new Book();
      $form = $request->all();
     
      #Bookモデルクラスのプロパティに値を代入
      /*$book->title = $request->title;
      $book->memo = $request->memo;
      $path = $request->file('image')->store('public/image');
      $book->image_path = basename($path);*/

      //$book->title = $_POST['ary_lists']['ttl'];
      //$book->memo = $_POST['ary_lists']['review'];


      $book->title = "notset";
      $book->memo = "notset";
      $book->image_path = "notset";

      $book->title = $request->title;
      $book->memo = $request->memo;

      //ファイルが送信されたか確認
      if($request->hasFile('book-create-image')){//バリデーションでチェックするなら、ここは無くてもいいかも
        //アップロードに成功しているか確認
        if($request->file('book-create-image')->isValid()){
          //storeを行うならここまで来ないとだめだと思います

          //s3アップロード開始
          $image = $request->file('book-create-image');
          //バケットの'bookimage'フォルダへアップロード
          $path = Storage::disk('s3')->putFile('/bookimage/', $image, 'public');
          $book->image_path = basename($path);

          //laravelのストレージに保存する場合
          //$path = $request->file('book-create-image')->store('public/image');
          //$book->image_path = basename($path);
        } else{
          
        }
      } else {

      }

      //phpinfo();

      //dd(env('AWS_DEFAULT_REGION'));
      //dd(config('filesystems.disks.s3'));
      
      //Storage::disk('s3')->put('/', file_get_contents(public_path('image/about_img01.jpg')), 'public');
      //アップロードした画像のフルパスを取得
      //$book->image_path = Storage::disk('s3')->url($path);


      $book->userid = Auth::id();// 現在認証されているユーザーの代入
      #Bookモデルクラスのsaveメソッドを実行
      $book->save();

      //DBdataを取得
      $ttl = "hogehoge";
      $review = "fugafuga";

      return response()->json(
              [
                  'ttl' => $ttl,
                  'review' => $review
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );

      /*return response()->json(
              [
                  'ttl' => $ttl,
                  'review' => $review
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );*/
  }

  #ajaxでbookの情報を更新
  public function cellUpdateAjax(Request $request){

    /*$sample = Book::find($_POST['ary_lists']['id']);
    $sample->title = $_POST['ary_lists']['ttl'];
    $sample->memo = $_POST['ary_lists']['review'];
    $sample->save();*/

    $book = Book::find($request->user_id);

    $book->title = "notset";
    $book->memo = "notset";
    //$book->image_path = "notset";


    $book->title = $request->title;
    $book->memo = $request->memo;
    //ファイルが送信されたか確認
    if($request->hasFile('book-update-image')){//バリデーションでチェックするなら、ここは無くてもいいかも
      //アップロードに成功しているか確認
      if($request->file('book-update-image')->isValid()){
        //storeを行うならここまで来ないとだめだと思います

        //s3アップロード開始
          $image = $request->file('book-update-image');
          //バケットの'bookimage'フォルダへアップロード
          $path = Storage::disk('s3')->putFile('/bookimage/', $image, 'public');
          $book->image_path = basename($path);

      } else{
        
      }
    } else {

    }
    
    $book->save();

    //DBdataを取得
    $ttl = $request->title;
    $review = $request->memo;
    return response()->json(
            [
                'ttl' => $ttl,
                'review' => $review
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
  }

  #ajaxでbookの情報を削除
  public function bookRemoveAjax(){

    $book = Book::findOrFail($_POST['id']);
    $book->delete();

      //DBdataを取得
      return response()->json(
              [
                  'id' => 1,
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }



  #任意のデータを取得して返す
  public function someGetter(){


      #Bookモデルクラスのオブジェクトを作成
      $book = new Book();

      //DBdataを取得
      $books = Book::where('userid', Auth::id())->get();
      $books->toArray();
      return response()->json(
              [
                  $books
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }
}