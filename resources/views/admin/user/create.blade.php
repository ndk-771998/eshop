@extends('layouts.admin')
@section('title')
<title>Admin</title>
@endsection

@section('css')
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: #000 !important;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Danh mục User', 'key' => 'Thêm mới'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label>Tên User</label>
                            <input class="form-control @error('name') in-valid @enderror" value="{{ old('name') }}" name="name" placeholder="Nhập username">
                            <small class="form-text text-muted">Nhập vào username</small>
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control @error('email') in-valid @enderror" value="{{ old('email') }}" name="email" placeholder="Nhập email">
                            <small class="form-text text-muted">Nhập vào email</small>
                            @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control @error('password') in-valid @enderror" value="" type="password" name="password" placeholder="Nhập password">
                            <small class="form-text text-muted">Nhập vào password</small>
                            @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tên User</label>
                            <select name="role_id[]" class="form-control role_user" multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }} </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Nhập vào tên user</small>
                            @error('name')
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
<script src="{{ asset('js/select2_add_product.js') }} "></script>
@endsection