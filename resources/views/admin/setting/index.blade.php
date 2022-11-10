@extends('layouts.admin')
@section('title')
<title>Settings</title>
@endsection
@section('js')
<script src="{{ asset('vendor/sweetAlert/sweetAlert.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['title' => 'Danh mục Setting', 'key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <div class="btn-group mb-3">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add Config
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('setting.create') . '?type=Text' }}" class="dropdown-item">Add Text</a>
                            <a href="{{ route('setting.create') . '?type=Textarea' }}" class="dropdown-item">Add Textarea</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 table-contents">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Config Key</th>
                                <th scope="col">Config Value</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                            <tr>
                                <td scope="row">{{ $setting->id }}</td>
                                <td>{{ $setting->config_key }}</td>
                                <td>{{ $setting->config_value }}</td>
                                <td>
                                    @if($setting->type === 'Text')
                                    <a href="{{ route('setting.edit', ['id' => $setting->id]) . '?type=Text' }}" class='btn btn-default'>Edit</a>
                                    @elseif($setting->type === 'Textarea')
                                    <a href="{{ route('setting.edit', ['id' => $setting->id]) . '?type=Textarea' }}" class='btn btn-default'>Edit</a>
                                    @endif
                                    <a href="" class="btn btn-danger action_delete" data-url="{{ route('setting.delete', ['id' => $setting->id]) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination">
                  {{ $settings->links("pagination::bootstrap-4") }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection