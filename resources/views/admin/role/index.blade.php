@extends('layouts.admin')
@section('title')
<title>Admin</title>
@endsection
@section('js')
<script src="{{ asset('vendor/sweetAlert/sweetAlert.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['title' => 'Danh mục Roles', 'key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <a href="{{ route('role.create') }}" class='btn btn-success float-right mb-2'>Add</a>
                </div>
                <div class="col-md-12 table-contents">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tên Roles</th>
                                <th scope="col">Tên vai trò</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td scope="row">{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>
                                    <a href="{{ route('role.edit', ['id' => $role->id]) }}" class='btn btn-default'>Edit</a>
                                    <a href="" data-url="{{ route('role.delete', ['id' => $role->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination">
                    {{$roles->links("pagination::bootstrap-4")}}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection