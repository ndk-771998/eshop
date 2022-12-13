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
    @include('partials.content-header', ['title' => 'Danh mục Users', 'key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <a href="{{ route('user.create') }}" class='btn btn-success float-right mb-2'>Add</a>
                </div>
                <div class="col-md-12 table-contents">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tên User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td scope="row">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class='btn btn-default'>Edit</a>
                                    <a href="" data-url="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination">
                    {{$users->links("pagination::bootstrap-4")}}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection