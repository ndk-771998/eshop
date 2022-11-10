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
    @include('partials.content-header', ['title' => 'Posts', 'key' => 'List'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <a href="{{route('post.create')}}" class='btn btn-success float-right mb-2'>Add</a>
                </div>
                <div class="col-md-12 table-contents">
                    <table class="table table_product">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Author</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->description}}</td>
                                <td>
                                    <img class="image_post" src="{{ $post->feature_image_path ? $product->feature_image_path : 'https://www.studytienganh.vn/upload/2021/05/98140.png' }}" alt="Product Image">
                                </td>
                                <td>
                                    {{ $post->category->category_name }}
                                </td>
                                <td>{{ $post->user_id }}</td>
                                <td>
                                    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-default">Edit</a>
                                    <a href="" class="btn btn-danger action_delete" data-url="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination">
                        {{$posts->links("pagination::bootstrap-4")}}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection