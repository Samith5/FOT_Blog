<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function index()
    {
        $blogCount = DB::table('blogs')->where('status', "!=",  '-1')->count();

        return view('dashboard.blog.index', ['count' => $blogCount]);
    }

    public function indexDetails()
    {
        $blogs = DB::table('blogs')->where('status', "!=",  '-1')->latest()->get();

        return Datatables::of($blogs)

            ->addIndexColumn()
            ->addColumn('actions', function ($blog) {
                $actions = '<div class="text-center"><span class="fas fa-edit px-2 mx-1 text-secondary" id="editBtn" data-id="' . $blog->url . '" ></span><span class="fas fa-trash px-2 mx-1 text-danger" id="removeBtn" data-id="' . $blog->url . '"></span></div>';
                return $actions;
            })
            ->addColumn('date', function ($blog) {
                return date("Y-m-d", strtotime($blog->created_at));
            })
            ->addColumn('title', function ($blog) {
                return "<a class='dt-title' target='_blank' href='" . route('blog', $blog->url) . "'> " . $blog->title . "</a>";
            })
            ->addColumn('blog_image', function ($blog) {
                $image = '<div class="text-center"><img src=/' . $blog->image . ' width="100px"  class="table-img"></div>';
                return $image;
            })
            ->addColumn('status', function ($blog) {
                if ($blog->status == 1) {
                    return '<div class="text-success"><i class="fas fa-check-circle mr-2"></i> PUBLISHED</div>';
                } else {
                    return '<div class="text-danger"><i class="fas fa-times-circle mr-2"></i> NOT PUBLISHED</div>';
                }
            })

            ->rawColumns(['title', 'actions', 'date', 'blog_image', 'status'])
            ->make(true);

        return $blogs;
    }

    public function addNewBlog(Request $request)
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

            $file = 'images/blogs/' . $url . '/' . uniqid() . '.jpeg';
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
        return redirect()->route('blogs.index');
    }

    public function updateBlog(Request $request)
    {
        $title = $request->editTitle ? $request->editTitle : '';
        $description = $request->editDescription ? $request->editDescription : '';
        $image = $request->editFilepond ? $request->editFilepond : '';
        $url = $request->url;
        $published = $request->editPublished ? '1' : '0';

        if ($title && $description && $image) {

            $image_ = DB::table('blogs')->where('url', $url)->select('image')->get();

            if ($image) {
                $image_ = $image_[0]->image;
                unlink($image_);

                $imgA = explode(',', $image);
                $imgA = str_replace('"}', '', $imgA[5]);
                $imgA = str_replace('"data":"', '', $imgA);
                $ImageData = base64_decode($imgA);

                if (!file_exists('images/blogs/' . $url)) {
                    mkdir('images/blogs/' . $url, 0777, true);
                }

                $file = 'images/blogs/' . $url . '/' . uniqid() . '.jpeg';
                $success = file_put_contents($file, $ImageData);

                if ($success) {

                    $affected = DB::table('blogs')->where('url', $url)->update([
                        'title' => $title,
                        'description' => $description,
                        'image' => $file,
                        'status' => $published,
                    ]);

                    if ($affected) {
                        Session::flash('status', ['1', "The blog details updated."]);
                    } else {
                        Session::flash('status', ['0', "Something went wrong. Please try again."]);
                    }
                } else {
                    Session::flash('status', ['0', "An error occurred when uploading capture. Please try again."]);
                }
            } else {
                Session::flash('status', ['0', "Something went wrong. Please try again."]);
            }
        } else {
            Session::flash('status', ['0', "Please enter required information."]);
        }
        return redirect()->route('blogs.index');
    }

    public function blogDetails(Request $request)
    {
        $url = $request->url;

        if ($url) {
            $blog = DB::table('blogs')->where([
                ['status', "!=",  '-1'],
                ['url', '=', $url],
            ])->get();

            $blog = json_decode($blog, true);
            return $blog;
        }
        return 0;
    }

    public function blogDelete(Request $request)
    {
        $url = $request->url;

        if ($url) {
            $affected = DB::table('blogs')->where('url', $url)->update([
                'status' => '-1',
            ]);

            return $affected;
        }
        return 0;
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
