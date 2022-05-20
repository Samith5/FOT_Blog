<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrondEndController extends Controller
{
    public function index()
    {
        $topBlogs = DB::table('blogs')->where('status', "!=",  '-1')->latest()->limit(6)->get();
        $blogs = DB::table('blogs')->where('status', "!=",  '-1')->latest()->get();

        return view('home', ['topBlogs' => $topBlogs, 'blogs' => $blogs]);
    }

    public function blogIndex($url)
    {
        // dd($url);

        $blog = DB::table('blogs')->where([['status', "!=",  '-1'], ['url', "=",  $url]])->first();
        if ($blog) {
            return view('blog', ['blog' => $blog]);
        } else {
            return redirect()->route('home');
        }
    }
}
