@extends('layouts.admin')
@section('title')
<title>Settings</title>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['title' => 'Danh mục Setting', 'key' => 'Cập nhật'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <form method="POST" action="{{ route('setting.update', ['id' => $setting->id]) }}">
                        @csrf()
                        <div class="form-group">
                            <label>Config Key</label>
                            <input class="form-control @error('config_key') in-valid @enderror" value="{{ $setting->config_key }}"  name="config_key" placeholder="Nhập tên config">
                            <small class="form-text text-muted">Nhập vào tên config</small>
                            @error('config_key')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(request()->type === 'Text')
                        <div class="form-group">
                            <label>Config Value</label>
                            <input class="form-control @error('config_value') in-valid @enderror" value="{{ $setting->config_value }}"  name="config_value" placeholder="Nhập giá trị config">
                            <small class="form-text text-muted">Nhập config value</small>
                            @error('config_value')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        @elseif(request()->type === 'Textarea')
                        <div class="form-group">
                            <label>Config Value</label>
                            <textarea name="config_value" class="form-control @error('config_value') in-valid @enderror" id="" cols="30" rows="5">{{ $setting->config_value }}</textarea>
                            <small class="form-text text-muted">Nhập config value</small>
                            @error('config_value')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
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