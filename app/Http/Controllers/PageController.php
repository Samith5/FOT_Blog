<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;


class PageController extends Controller
{
    public function index()
    {
        $blogCount = DB::table('blogs')->where('status', '0')->count();

        return view('dashboard.blog.index', ['count' => $blogCount]);
    }

    public function indexDetails()
    {
        $blogs = DB::table('blogs')->where('status', '0')->latest()->get();

        return Datatables::of($blogs)

            ->addIndexColumn()
            ->addColumn('actions', function ($blog) {
                $actions = '<div class="text-center"><span class="fas fa-edit px-2" data-id="' . $blog->url . '" data-toggle="modal" data-target="#editModel" class="btn btn-success" target="editModel"></span><span class="fas fa-trash px-2" id="removeBtn" data-id="' . $blog->url . '"></span></div>';
                return $actions;
            })
            ->addColumn('date', function ($blog) {
                return date("Y-m-d", strtotime($blog->created_at));;
            })
            ->addColumn('blog_image', function ($blog) {
                $image = '<div class="text-center"><img src=/' . $blog->image . ' width="100px"  class="table-img"></div>';
                return $image;
            })
            ->addColumn('status', function ($member) {
                if ($member->status == 1) {
                    return '<div><i class="fas fa-check-circle mr-2"></i> PUBLISHED</div>';
                } else {
                    return '<div><i class="fas fa-times-circle mr-2"></i> NOT PUBLISHED</div>';
                }
            })

            ->rawColumns(['actions', 'date', 'blog_image', 'status'])
            ->make(true);

        return $blogs;
    }

    public function addNewPage(Request $request)
    {

        $title = $request->title ? $request->title : '';
        $description = $request->description ? $request->description : '';
        $image = $request->filepond ? $request->filepond : '';
        $url = $this->slugify($title);
        $published = $request->published ? '1' : '0';

        if ($title && $description && $image) {
            $imgA = explode(',', $image);
            $imgA = str_replace('"}', '', $imgA[5]);
            $imgA = str_replace('"data":"', '', $imgA);
            $ImageData = base64_decode($imgA);

            if (!file_exists('images/blogs/' . $url)) {
                mkdir('images/blogs/' . $url, 0777, true);
            }

            $file = 'images/blogs/' . $url . uniqid() . '.jpeg';
            $success = file_put_contents($file, $ImageData);

            if ($success) {
                $blog = new Blogs();

                $blog->title = $title;
                $blog->description = $description;
                $blog->image = $file;
                $blog->url = $url;
                $blog->status = $published;
                $blog->save();
                Session::flash('status', ['1', "New blog added."]);
            } else {
                Session::flash('status', ['0', "An error occurred when uploading capture. Please try again."]);
            }
        } else {
            Session::flash('status', ['0', "Please enter required information."]);
        }
        return redirect()->route('blog.index');
    }

    public  function slugify($string)
    {
        $string = $string . '-' . hash('ripemd160', time());
        $slug = trim($string);
        $slug = preg_replace('/[^a-zA-Z0-9 -]/', '', $slug);
        $slug = str_replace(' ', '-', $slug);
        $slug = strtolower($slug);
        return $slug;
    }
}
