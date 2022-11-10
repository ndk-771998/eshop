@extends('layouts.admin')
@section('title')
<title>Sản phẩm</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/product_index.css') }}">
@endsection
@section('js')
<script src="{{ asset('vendor/sweetAlert/sweetAlert.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['title' => 'Sản phẩm', 'key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <a href="{{route('products.create')}}" class='btn btn-success float-right mb-2'>Add</a>
                </div>
                <div class="col-md-12 table-contents">
                    <table class="table table_product">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Số lượng tồn</th>
                                <th scope="col">Đã bán</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    <img class="image_product" src="{{ $product->feature_image_path ? $product->feature_image_path : 'https://www.studytienganh.vn/upload/2021/05/98140.png' }}" alt="Product Image">
                                </td>
                                <td>
                                    {{ $product->category->category_name }}
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->sold }}</td>
                                <td>
                                    <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-default">Edit</a>
                                    <a href="" class="btn btn-danger action_delete" data-url="{{ route('products.delete', ['id' => $product->id]) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination">
                        {{$products->links("pagination::bootstrap-4")}}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection