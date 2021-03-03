<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class UserPageController extends Controller
{
    #useridをフックに取得したデータベース情報をcompactで渡しておく
    public function getAbout($id) {
      $users = User::where('id', $id)->get();
      $books = Book::where('userid', $id)->get();
      $books->toArray();
      return view('pages.list',compact('users','books'));
    }
}
