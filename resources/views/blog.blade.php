@extends('layouts.app')

@section('title')
{{$blog->title}} | FOT BLOG
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row bg-light2">
                <div class="col my-auto">
                    <div class="px-5">
                        <div class="p-1">
                            <div class="blog-title">{{$blog->title}}</div>
                            <small>{{date("M d, Y", strtotime($blog->created_at))}}</small>
                        </div>
                    </div>
                </div>

                <div class="col p-0">
                    <img src="/{{$blog->image}}" class="d-block w-100" alt="{{$blog->title}}">
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="row bg-light">
                <div class="col my-auto">
                    <div class="px-5" id="description" data='{{$blog->description}}'>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        var data = $("#description").attr('data');
        $("#description").html(data);
        console.log(data);
    });
</script>
@endsection