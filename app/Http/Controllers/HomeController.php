<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showcase;
use App\Models\Showcase_item;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showcases = Showcase::where('user_id', Auth::id())->get();
        $showcases->toArray();


        return response(view('dashboard',compact('showcases'))
            ->withHeaders([
                'Cache-Control' => 'no-store',
            ])
          );
    }
}
