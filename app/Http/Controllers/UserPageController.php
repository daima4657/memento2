<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Showcase;
use App\Models\Showcase_item;

class UserPageController extends Controller
{
    #useridをフックに取得したデータベース情報をcompactで渡しておく
    public function getShowcaseDetail($id,$title) {
    $showcase_title = $title;
      $users = User::where('id', $id)->get();

      #ShowcaseカラムからタイトルとユーザーIDを利用して呼び出すショーケースのIDを取得する
      $showcases = Showcase::where([
      	['name', $title],
      	['user_id',$id]
      ])->get();

      #LaravelのCollectionで指定した列の情報のみを再取得する
      $showcase_subset = $showcases->map(function($showcase){
      	return collect($showcase->toArray())
      		->only(['id'])
      		->all();
      });

      #ユーザーのIDと先ほど入手したShowcaseのIDを利用して取得するデータを絞り込む
      $showcase_items = Showcase_item::where([
      	['userid', $id],
      	['showcase_id', $showcase_subset[0]['id']]
      ])->get();

      $showcase_items->toArray();
      return view('pages.showcase_detail',compact('users','showcase_items','showcase_title'));
    }
}
