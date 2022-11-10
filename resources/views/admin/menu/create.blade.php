@extends('layouts.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Danh mục Menu', 'key' => 'Thêm mới'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                <form method="POST" action="{{route('menus.store')}}">
                    @csrf()
                    <div class="form-group">
                        <label>Tên Menu</label>
                        <input class="form-control" name="menu_name" placeholder="Nhập tên menu">
                        <small class="form-text text-muted">Nhập vào tên menu</small>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn menu cha</label>
                        <select name="parent_id" id="" class='form-control'>
                            <option value="0">Chọn menu cha</option>
                            {!! $optionSelect !!}
                        </select>
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