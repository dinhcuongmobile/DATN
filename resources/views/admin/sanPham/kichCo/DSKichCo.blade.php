@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách các loại size ({{$kich_cos->count()}})</h1>
        @if (session('success'))
            <div class="alert alert-success" id="error-alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{route('san-pham.show-them-size')}}"><button type="button"
                                class="btn btn-secondary btn-sm">Nhập thêm</button></a>
            </div>
            <div class="card-body" id="table_sp">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Size</th>
                                @if (Auth::user()->vai_tro_id == 1)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($kich_cos->count() > 0)
                                @foreach ($kich_cos as $index => $item)
                                <tr>
                                    <td class="col-1 align-middle text-center">{{$index+1}}</td>
                                    <td class="col-8 align-middle text-center">{{$item->kich_co}}</td>
                                    @if (Auth::user()->vai_tro_id == 1)
                                        <td class="text-center col-2 align-middle">
                                            <a  onclick="return confirm('Bạn chắc chắn muốn xóa size này?')"
                                                href="{{route('san-pham.xoa-size',$item->id)}}" class="btn btn-danger btn-sm">
                                                <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Xóa</span></a>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
