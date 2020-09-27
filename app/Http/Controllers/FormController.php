<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
      $books->toArray();
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
          $path = $request->file('book-create-image')->store('public/image');
          $book->image_path = basename($path);
        } else{
          
        }
      } else {

      }

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
        $path = $request->file('book-update-image')->store('public/image');
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