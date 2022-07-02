<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrondEndController extends Controller
{
    public function index()
    {
        $topBlogs = DB::table('blogs')->where('status', "=",  '1')->latest()->limit(6)->get();
        $blogs = DB::table('blogs')->where('status', "=",  '1')->latest()->paginate(9);

        return view('home', ['topBlogs' => $topBlogs, 'blogs' => $blogs]);
    }

    public function blogIndex($url)
    {
        $blog = DB::table('blogs')->where([['status', "=",  '1'], ['url', "=",  $url]])->first();
        if ($blog) {
            return view('blog', ['blog' => $blog]);
        } else {
            return redirect()->route('home');
        }
    }

    public function pagesIndex($url)
    {
        if ($url == 'Sports') {
            $blogs = DB::table('blogs')
                ->where([
                    ['description', 'LIKE', '%sport%'],
                    ['status', "=",  '1']
                ])
                ->orWhere([
                    ['title', 'LIKE', '%sport%'],
                    ['status', "=",  '1']
                ])
                ->latest()
                ->get();

            return view('pages', ['blogs' => $blogs, 'page' => $url]);
        } else {
            $blogs = DB::table('blogs')
                ->where([
                    ['description', 'LIKE', '%' . $url . '%'],
                    ['status', "=",  '1']
                ])
                ->orWhere([
                    ['title', 'LIKE', '%' . $url . '%'],
                    ['status', "=",  '1']
                ])
                ->latest()
                ->get();

            return view('pages', ['blogs' => $blogs, 'page' => $url]);
        }
    }

    public function searchIndex(Request $request)
    {
        $url = $request->q;

        if ($url == 'Sports') {
            $blogs = DB::table('blogs')
                ->where([
                    ['description', 'LIKE', '%sport%'],
                    ['status', "=",  '1']
                ])
                ->orWhere([
                    ['title', 'LIKE', '%sport%'],
                    ['status', "=",  '1']
                ])
                ->latest()
                ->get();

            return view('pages', ['blogs' => $blogs, 'page' => $url]);
        } else {
            $blogs = DB::table('blogs')
                ->where([
                    ['description', 'LIKE', '%' . $url . '%'],
                    ['status', "=",  '1']
                ])
                ->orWhere([
                    ['title', 'LIKE', '%' . $url . '%'],
                    ['status', "=",  '1']
                ])
                ->latest()
                ->get();

            return view('search', ['blogs' => $blogs, 'query' => $url]);
        }
    }
}
