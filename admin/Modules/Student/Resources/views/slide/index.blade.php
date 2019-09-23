@extends('layouts.admin_default')
@section('title', 'Quản lý học sinh')
@section('content')
    <section class="content-header">
        <h1>Quản lý slide</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh sách slide</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if(session()->has('messages'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Thành công</h4>
                        {{session('messages')}}
                    </div>
                @else
                @endif
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header">

                        <h3 class="box-title">Danh sách slide</h3>
                        @if(Auth::user()->hasPermission(\Illuminate\Support\Facades\Session::get('controller'), "create"))
                            <div class="pull-right">
                                <a class="btn btn-success btn-sm" href="#" onclick="return slideHelper.createSlide()">Thêm mới slide</a>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <table id="post_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($slides) > 0)
                                @foreach($slides as $slide)
                                    <tr>
                                        <td>{{ $slide->id }}</td>
                                        <td><img width="500px" height="200px" src="{{ asset('/img/slide/'.$slide->images) }}"></td>
                                        <td>{{ $slide->created_at }}</td>
                                        <td>
                                            <a href="#" onclick="slideHelper.editSlide('{{ $slide->id }}')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>
                                            <a href="{{ route('slide.delete', $slide->id) }} " onclick="return confirm('Bạn có muốn xoá slide này ?')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $slides->links() }}
                            @else
                                <tr>
                                    <td colspan="4">Không có dữ liệu</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset("js/slide.js") }}"></script>
@endsection
