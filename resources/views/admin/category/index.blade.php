@extends('layouts.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['title' => 'Danh mục sản phẩm', 'key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <a href="{{route('categories.create')}}" class='btn btn-success float-right mb-2'>Add</a>
                </div>
                <div class="col-md-12 table-contents">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Danh mục cha</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->parent_id}}</td>
                            <td>{{$category->category_desc}}</td>
                            <td><img width="100" height="100" src="{{$category->image_path}}" alt="Image Category"></td>
                            <td>
                                <a href="{{route('categories.edit', ['id' => $category->id])}}" class='btn btn-default'>Edit</a>
                                <a href="{{route('categories.delete', ['id' => $category->id])}}" class='btn btn-danger'>Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="col-md-12 pagination">
                    {{ $categories->links("pagination::bootstrap-4") }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection