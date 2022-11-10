@extends('layouts.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Danh mục Slider', 'key' => 'Thêm mới'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <form method="POST" action="{{ route('slider.update', ['id' => $slider->id]) }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label>Tên slider</label>
                            <input class="form-control @error('name') in-valid @enderror" value="{{ $slider->name }}"  name="name" placeholder="Nhập tên slider">
                            <small class="form-text text-muted">Nhập vào tên slider</small>
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tên slider</label>
                            <textarea name="description" class="form-control @error('description') in-valid @enderror" id="" cols="30" rows="10">{{ $slider->description }}</textarea>
                            <small class="form-text text-muted">Nhập mô tả slider</small>
                            @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="image_path" class="@error('image_path') in-valid @enderror" value="{{ $slider->image_name }}" id="">
                            <img src="{{ $slider->image_path }}" width="100" height="100" alt="Image Item">
                            <small class="form-text text-muted">Chọn ảnh slider</small>
                            @error('image_path')
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