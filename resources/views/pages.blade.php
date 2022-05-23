@extends('layouts.app')

@section('title')
{{$page}} | FOT BLOG
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h5 class="mt-1">{{$page}} Blogs</h5>
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
                        <p class="card-text text-secondary">{{substr(strip_tags($blog->description), 0, 120)}}...</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection