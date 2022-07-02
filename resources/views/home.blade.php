@extends('layouts.app')

@section('title')
Home | FOT BLOG
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5 class="mb-0">Trendings</h5>
            <hr class="mt-2">


            <div id="carouselHome" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselHome" data-bs-slide-to="0" class="active"></button>
                    @if(sizeof($topBlogs))
                    @foreach($topBlogs as $key=>$tblog)
                    <button type="button" data-bs-target="#carouselHome" data-bs-slide-to="{{$key+1}}"></button>
                    @endforeach
                    @endif
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row bg-secondary">
                            <div class="col">
                                <img src="/img/new.jpg" class="d-block w-100" alt="FOT_Blog">
                            </div>
                        </div>
                    </div>
                    @if(sizeof($topBlogs))
                    @foreach($topBlogs as $key=>$tblog)
                    <div class="carousel-item ">
                        <div class="row bg-secondary">
                            <div class="col my-auto">
                                <div class="px-5">
                                    <div class="p-1">
                                        <h5 class="text-white tblog-title">{{$tblog->title}}</h5>
                                        <p class="text-white mb-4"><i>{{substr(strip_tags($tblog->description), 0, 120)}}...</i></p>
                                        <a href="{{route('blog', $tblog->url)}}" class="btn btn-dark">Continue Reading</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="/{{$tblog->image}}" class="d-block w-100" alt="{{$tblog->title}}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselHome" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h5 class="mt-5">All Blogs</h5>
            <hr class="mt-2">
            @if(sizeof($blogs))
            <div class="row d-flex flex-wrap justify-content-center">
                @foreach($blogs as $blog)
                <div class="card col-xl-4 col-lg-4 col-md-4 col-sm-12 d-flex m-2 px-0 blog-outer">
                    <div class="blog-image-div">
                        <a href="{{route('blog', $blog->url)}}"><img src="/{{$blog->image}}" class="card-img-top blog-image" alt="{{$blog->title}}" style="height:224px"></a>
                    </div>
                    <div class="card-body">
                        <a href="{{route('blog', $blog->url)}}">
                            <h5 class="card-title blog-title mb-0">{{$blog->title}}</h5>
                        </a>
                        <div class="text-right blog-date mb-2"><small>{{date("M d, Y", strtotime($blog->created_at))}}</small></div>
                        <p class="card-text text-secondary blog-desc">{{substr(strip_tags($blog->description), 0, 120)}}...</p>
                    </div>
                </div>
                @endforeach
                <div class="d-flex justify-content-end mt-3">
                    {{ $blogs->links() }}
                </div>
                @else
                <div class="alert alert-info text-center">No Blogs Found!</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection