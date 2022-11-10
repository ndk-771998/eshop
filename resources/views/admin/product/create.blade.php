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
    @include('partials.content-header', ['title' => 'Sản phẩm', 'key' => 'Thêm mới'])
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
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input class="form-control @error('name') in-valid @enderror" name="name" value="{{ old('name') }}" placeholder="Nhập tên sản phẩm">
                            <small class="form-text text-muted">Nhập vào tên sản phẩm</small>
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input class="form-control @error('price') in-valid @enderror" name="price" value="{{ old('price') }}" placeholder="Nhập giá sản phẩm">
                            <small class="form-text text-muted">Nhập vào giá sản phẩm</small>
                            @error('price')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input class="form-control-file" name="feature_image_path" type='file'>
                            <small class="form-text text-muted">Chọn ảnh sản phẩm</small>
                        </div>

                        <div class="form-group">
                            <label>Ảnh chi tiết sản phẩm</label>
                            <input class="form-control-file" multiple name="image_path[]" type='file'>
                            <small class="form-text text-muted">Chọn ảnh sản phẩm</small>
                        </div>

                        <div class="form-group">
                            <label for="">Chọn danh mục</label>
                            <select name="category_id" id="" class="form-control category_product @error('category_id') in-valid @enderror">
                                <option value="">Chọn danh mục</option>
                                {!! $categoryList !!}
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Nhập tags cho sản phẩm</label>
                            <select class="form-control tags_product" name="tags[]" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả sản phẩm</label>
                            <textarea class="form-control tinymce_editor @error('content') in-valid @enderror" name="content" id="" cols="30" rows="20">{{ old('content') }}</textarea>
                            <small class="form-text text-muted">Mô tả sản phẩm cần dùng để lưu ý cho người nhập</small>
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