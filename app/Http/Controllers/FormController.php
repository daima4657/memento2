<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Showcase;
use App\Models\Showcase_item;
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


  #ajaxでshoe case itemの情報を取得
  public function getShowcaseItemAjax(){


      #Bookモデルクラスのオブジェクトを作成
      $showcase_items = new Showcase_item();

      //DBdataを取得
      $showcase_items = Showcase_item::where('id', $_POST['id'])->get();
      $showcase_items[0]['last_update_date'] = date('Y.m.d h:i:s', strtotime($showcase_items[0]['updated_at']));
      $showcase_items->toJSON();
      return response()->json(
              [
                  $showcase_items
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }


  #ajaxでshowcaseの情報を追加
  public function showcaseAddAjax(Request $request){


      #Showcaseモデルクラスのオブジェクトを作成
      $showcase = new Showcase();
      $form = $request->all();

      $showcase->user_id = 0;
      $showcase->name = "notset";


      $showcase->user_id = Auth::id();// 現在認証されているユーザーの代入
      $showcase->name = $request->title;
      #Showcaseモデルクラスのsaveメソッドを実行
      $showcase->save();

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

  #ajaxでshowcaseの情報を削除
  public function ShowcasesRemoveAjax(){

    $showcase = Showcase::findOrFail($_POST['id']);
    $showcase->delete();

      //DBdataを取得
      return response()->json(
              [
                  'id' => 1,
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }


  #ajaxで新規ショーケースアイテムを追加
  public function AddNewItemAjax(Request $request){


      #Bookモデルクラスのオブジェクトを作成
      $showcase_items = new Showcase_item();
      $form = $request->all();
     
      #Bookモデルクラスのプロパティに値を代入
      /*$book->title = $request->title;
      $book->memo = $request->memo;
      $path = $request->file('image')->store('public/image');
      $book->image_path = basename($path);*/

      //$book->title = $_POST['ary_lists']['ttl'];
      //$book->memo = $_POST['ary_lists']['review'];


      $showcase_items->title = "notset";
      $showcase_items->memo = "notset";
      $showcase_items->image_path = "notset";

      $showcase_items->title = $request->title;
      $showcase_items->memo = $request->memo;

      //ファイルが送信されたか確認
      if($request->hasFile('book-create-image')){//バリデーションでチェックするなら、ここは無くてもいいかも
        //アップロードに成功しているか確認
        if($request->file('book-create-image')->isValid()){
          //storeを行うならここまで来ないとだめだと思います

          //s3アップロード開始
          $image = $request->file('book-create-image');
          //バケットの'bookimage'フォルダへアップロード
          $path = Storage::disk('s3')->putFile('/bookimage/', $image, 'public');
          $showcase_items->image_path = basename($path);

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


      $showcase_items->userid = Auth::id();// 現在認証されているユーザーの代入


      #ShowcaseカラムからタイトルとユーザーIDを利用して呼び出すショーケースのIDを取得する
      $showcases = Showcase::where([
        ['name', $request->showcase_name],
        ['user_id',Auth::id()]
      ])->get();

      #LaravelのCollectionで指定した列の情報のみを再取得する
      $showcase_subset = $showcases->map(function($showcase){
        return collect($showcase->toArray())
          ->only(['id'])
          ->all();
      });

      

      $showcase_items->showcase_id = $showcase_subset[0]['id'];// 所属するショーケースのID
      #Bookモデルクラスのsaveメソッドを実行
      $showcase_items->save();

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

  #ajaxでShow case itemの情報を更新
  public function editShowcaseItemAjax(Request $request){

    /*$sample = Book::find($_POST['ary_lists']['id']);
    $sample->title = $_POST['ary_lists']['ttl'];
    $sample->memo = $_POST['ary_lists']['review'];
    $sample->save();*/

    $showcase_item = Showcase_item::find($request->showcase_id);

    $showcase_item->title = "notset";
    $showcase_item->memo = "notset";
    //$book->image_path = "notset";


    $showcase_item->title = $request->title;
    $showcase_item->memo = $request->memo;

    //ファイルが送信されたか確認
    if($request->hasFile('book-update-image')){//バリデーションでチェックするなら、ここは無くてもいいかも
      //アップロードに成功しているか確認
      if($request->file('book-update-image')->isValid()){
        //storeを行うならここまで来ないとだめだと思います

        //s3アップロード開始
          $image = $request->file('book-update-image');
          //バケットの'bookimage'フォルダへアップロード
          $path = Storage::disk('s3')->putFile('/bookimage/', $image, 'public');
          $showcase_item->image_path = basename($path);

      } else{
        
      }
    } else {
      //return "wrrrryyyyy!!!";
    }

    
    $showcase_item->save();

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

  #ajaxで任意のShow case itemを削除
  public function removeShowcaseItemAjax(){

    $showcase_item = Showcase_item::findOrFail($_POST['id']);
    $showcase_item->delete();

      //DBdataを取得
      return response()->json(
              [
                  'id' => 1,
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }

  #Showcaseテーブルから情報を取得する
  public function ShowcasesGetter(){


      #Bookモデルクラスのオブジェクトを作成
      $showcases = new Showcase();

      //DBdataを取得
      $showcases = Showcase::where('user_id', Auth::id())->get();
      $showcases->toArray();
      return response()->json(
              [
                  $showcases
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }



  #特定のショーケース内のメモリーを全て取得する
  public function getMemory(Request $request){

    $data = $request->all();

    $user_id = $data['user_id'];
    $showcase_name = $data['showcase_name'];

    #ShowcaseカラムからタイトルとユーザーIDを利用して呼び出すショーケースのIDを取得する
    $showcases = Showcase::where([
      ['name', $showcase_name],
      ['user_id',$user_id]
    ])->get();

    #LaravelのCollectionで指定した列の情報のみを再取得する
    $showcase_subset = $showcases->map(function($showcase){
      return collect($showcase->toArray())
        ->only(['id'])
        ->all();
    });

      #Bookモデルクラスのオブジェクトを作成
      $showcase_item = new Showcase_item();

      //DBdataを取得
      $showcase_items = Showcase_item::where([
        ['userid', $user_id],
        ['showcase_id', $showcase_subset[0]['id']]
      ])->get();
      
      $showcase_items->toArray();
      return response()->json(
              [
                  $showcase_items
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }


  #任意のデータを取得して返す
  public function someGetter(){

      #Bookモデルクラスのオブジェクトを作成
      $showcase_item = new Showcase_item();

      //DBdataを取得
      $showcase_items = Showcase_item::where('userid', Auth::id())->get();
      $showcase_items->toArray();
      return response()->json(
              [
                  $showcase_items
              ],
              200,[],
              JSON_UNESCAPED_UNICODE
          );
  }
}