<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
		#getでaboutにアクセスした時の処理
		public function getAbout() { return view('pages.about');
	  }
}
