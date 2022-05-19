@extends('dashboard.layout')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <button type="button" class="btn btn-primary  mx-2" data-toggle="modal" data-target="#addNewModel"><i class="fas fa-plus pr-2"></i>Add New Page
            </div>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if($count == 0)
                            <div class="alert alert-info text-center">
                                No Blogs Found!
                            </div>
                            @else
                            <div id="blogsTableDiv">
                                <table id="blogsTable" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- ADD Modal -->
<div class="modal fade" id="addNewModel" tabindex="-1" role="dialog" aria-labelledby="addNewModelTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('blogs.addNew')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewModelTitle">Add New Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-2 form-label" for="title">Page Title </label>
                            <input type="text" class="form-control" placeholder="Title" name="title" id="title" autofocus required maxlength="100">
                            <div id="titleError" class="d-none inputError"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-2 form-label" for="description">Page Description </label>
                            <textarea class="form-control" placeholder="Description" name="description" id="description" required maxlength="4500"></textarea>
                        </div>
                    </div>
                    <div class="mb-4 m-0">

                        <input type="file" class="filepond" required id="filepond" name="filepond" accept="image/png, image/jpeg, image/gif" />
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="published" name="published" checked>
                        <label class="form-check-label" for="published">Published</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('blogs.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewModelTitle">Edit Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-2 form-label" for="title">Page Title </label>
                            <input type="text" class="form-control" placeholder="Title" name="title" id="title" autofocus required maxlength="100">
                            <div id="titleError" class="d-none inputError"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="mb-2 form-label" for="description">Page Description </label>
                            <textarea class="form-control" placeholder="Description" name="description" id="description" required maxlength="4500"></textarea>
                        </div>
                    </div>
                    <div class="mb-4 m-0">

                        <input type="file" class="filepond" required id="filepond" name="filepond" accept="image/png, image/jpeg, image/gif" />
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="published" name="published" checked>
                        <label class="form-check-label" for="published">Published</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>

<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script type="text/javascript" src="{{ URL::asset('dashboard/custom/js/pages/pages.js') }}"></script>
@endsection