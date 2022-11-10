@extends('layouts.admin')
@section('title')
<title>Update Product</title>
@endsection

@section('css')
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/select2_tag_product.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Sản phẩm', 'key' => 'Chỉnh sửa'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('products.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                            <small class="form-text text-muted">Nhập vào tên sản phẩm</small>
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input class="form-control" name="price" placeholder="Nhập giá sản phẩm" value="{{$product->price}}">
                            <small class="form-text text-muted">Nhập vào giá sản phẩm</small>
                        </div>
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input class="form-control-file" name="feature_image_path" type='file'>
                            <img src="{{ $product->feature_image_path }}" class="img-thumbnail" alt="Image Product">
                            <small class="form-text text-muted">Chọn ảnh sản phẩm</small>
                        </div>

                        <div class="form-group">
                            <label>Ảnh chi tiết sản phẩm</label>
                            <input class="form-control-file" multiple name="image_path[]" type='file'>
                            <small class="form-text text-muted">Chọn ảnh sản phẩm</small>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($product->productImages as $value)
                                    <div class="col-md-3">
                                        <img src="{{$value->image_path}}" class="img-thumbnail" alt="Image Product Item">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Chọn danh mục</label>
                            <select name="category_id" id="" class='form-control category_product'>
                                <option value="">Chọn danh mục</option>
                                {!! $categoryList !!}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Nhập tags cho sản phẩm</label>
                            <select class="form-control tags_product" name="tags[]" multiple="multiple">
                                @foreach($product->productTags as $value)
                                    <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả sản phẩm</label>
                            <textarea class="form-control tinymce_editor" name="content" id="" cols="30" rows="20">{{ $product->content }}</textarea>
                            <small class="form-text text-muted">Mô tả sản phẩm cần dùng để lưu ý cho người nhập</small>
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