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

@section('js')
<script type="text/javascript">
    $('.checkbox_wrapper').on('click', function(){
        $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    })
</script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Danh mục User', 'key' => 'Chỉnh sửa'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <form method="POST" action="{{ route('role.update', ['id' => $role->id]) }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label>Tên User</label>
                            <input class="form-control @error('name') in-valid @enderror" value="{{ $role->name }}" name="name" placeholder="Nhập name">
                            <small class="form-text text-muted">Nhập vào Name</small>
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control @error('email') in-valid @enderror" value="{{ $role->display_name }}" name="display_name" placeholder="Nhập display name">
                            <small class="form-text text-muted">Nhập vào Display Name</small>
                            @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Module Quản lý</label>
                            <div class="row">
                                @foreach ($permissionParents as $permissionItem)
                                <div class="col-6">
                                    <div class="card">
                                        <h5 class="card-header">
                                            <input type="checkbox" class="checkbox_wrapper">
                                            Module {{ $permissionItem->name }}
                                        </h5>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($permissionItem->permissionChild as $perChild)
                                                <div class="col-6">
                                                    <input {{ $permissionChecked->contains('id', $perChild->id) ? 'checked' : '' }} type="checkbox" class="checkbox_childrent" value="{{ $perChild->id }}" name="permission_id[]">
                                                    <label for="permission_id" class="text-blue">{{ $perChild->display_name }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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