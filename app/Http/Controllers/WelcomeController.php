<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Contact;

class WelcomeController extends Controller
{
    public function index()
    {
    	return view('pages.welcome');
    }

    public function contact()
    {
    	return view("contact");
    }

		#getでgreeting/indexにアクセスした時の処理
		public function getIndex() { return view('greeting', ['message' => 'あなたの名前を入力してください。']);
	  }
	 
	  #postでgreeting/indexにアクセスしたときの処理
	  public function postIndex(Request $request)
	  {
	  $res = "こんにちは！" . $request->input('onamae')."さん！！";
	  return view('greeting', ['message' => $res]);
	  }
}