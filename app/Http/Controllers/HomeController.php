<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movies = Title::movies()->orderBy('release_date','desc')->take(10)->get();
        $serieses = Title::series()->orderBy('release_date','desc')->take(10)->get();
        return view('home',compact('movies','serieses'));
    }
    public function admin()
    {
        return view('dashboard');
    }
}
