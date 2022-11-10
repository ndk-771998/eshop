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
    @include('partials.content-header', ['title' => 'Danh mục Slider', 'key' => 'Danh sách'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 btn-functions">
                    <a href="{{ route('slider.create') }}" class='btn btn-success float-right mb-2'>Add</a>
                </div>
                <div class="col-md-12 table-contents">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td scope="row">{{ $slider->id }}</td>
                                <td>{{ $slider->name }}</td>
                                <td>{{ $slider->description }}</td>
                                <td><img width="100" height="100" src="{{ $slider->image_path }}" alt=""></td>
                                <td>
                                    <a href="{{ route('slider.edit', ['id' => $slider->id]) }}" class='btn btn-default'>Edit</a>
                                    <a href="" class="btn btn-danger action_delete" data-url="{{ route('slider.delete', ['id' => $slider->id]) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pagination">
                    {{$sliders->links("pagination::bootstrap-4")}}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection