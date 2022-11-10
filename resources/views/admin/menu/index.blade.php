@extends('layouts.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['title' => 'Danh mục Menu', 'key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <a href="{{route('menus.create')}}" class='btn btn-success float-right mb-2'>Add</a>
                </div>
                <div class="col-md-12 table-contents">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tên Menu</th>
                                <th scope="col">Danh mục cha</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                            <tr>
                                <td scope="row">{{$menu->id}}</td>
                                <td>{{$menu->menu_name}}</td>
                                <td>{{$menu->parent_id}}</td>
                                <td>
                                    <a href="{{route('menus.edit', ['id' => $menu->id])}}" class='btn btn-default'>Edit</a>
                                    <a href="{{route('menus.delete', ['id' => $menu->id])}}" class='btn btn-danger'>Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination">
                    {{$menus->links("pagination::bootstrap-4")}}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection