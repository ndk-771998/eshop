@extends('layouts.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Danh mục sản phẩm', 'key' => 'Cập nhật'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                <form method="POST" action="{{route('categories.update', ['id' => $category->id])}}" enctype="multipart/form-data">
                    @csrf()
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input class="form-control" name="category_name" value="{{$category->category_name}}" placeholder="Nhập tên danh mục">
                        <small class="form-text text-muted">Nhập vào tên danh mục</small>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục cha</label>
                        <select name="parent_id" id="" class='form-control'>
                            <option value="0">Chọn danh mục cha</option>
                            {!! $categoryList !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả danh mục sản phẩm</label>
                        <textarea class="form-control" name="category_desc" id="" cols="30" rows="5">{{$category->category_desc}}</textarea>
                        <small class="form-text text-muted">Mô tả danh mục cần dùng để lưu ý cho người nhập</small>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh danh mục</label>
                        <input class="form-control" type="file" name="image_path" value="{{ $category->image_path }}">
                        <small class="form-text text-muted">Chọn ảnh cho danh mục</small>
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