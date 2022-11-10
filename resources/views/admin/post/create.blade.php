@extends('layouts.admin')
@section('title')
<title>Create Product</title>
@endsection

@section('css')
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/select2_tag_product.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Post', 'key' => 'Create'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div> -->
                <div class="col-md-12">
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control @error('title') in-valid @enderror" name="title" value="{{ old('title') }}" placeholder="Title of post">
                            <small class="form-text text-muted">Enter title of post</small>
                            @error('title')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control @error('description') in-valid @enderror" name="description" value="{{ old('description') }}"></textarea>
                            <small class="form-text text-muted">Enter description</small>
                            @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control-file" name="feature_image_path" type='file'>
                            <small class="form-text text-muted">Pick of image</small>
                        </div>

                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control category_post @error('category_id') in-valid @enderror">
                                <option value="">Select category</option>
                                {!! $categoryList !!}
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Contents</label>
                            <textarea class="form-control tinymce_editor @error('content') in-valid @enderror" name="content" id="" cols="30" rows="20">{{ old('content') }}</textarea>
                            <small class="form-text text-muted">Content of post</small>
                            @error('content')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection

@section('js')
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script src="{{ asset('js/select2_add_product.js') }} "></script>
@endsection