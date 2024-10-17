@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách các loại màu sắc</h1>
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
                <a href="{{route('san-pham.show-them-mau-sac')}}"><button type="button"
                                class="btn btn-secondary btn-sm">Nhập thêm</button></a>
            </div>
            <div class="card-body" id="table_sp">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tên màu</th>
                                <th>Màu sắc</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($mau_sacs)>0)
                                @foreach ($mau_sacs as $index => $item)
                                <tr>
                                    <td class="col-1 align-middle text-center">{{$index+1}}</td>
                                    <td class="col-6 align-middle text-center">{{$item->ten_mau}}</td>
                                    <td class="col-3 align-middle text-center">
                                        <div class="color-circle" style="background-color: {{$item->ma_mau}};"></div>
                                    </td>
                                    <td class="text-center col-2 align-middle">
                                        <a  onclick="return confirm('Bạn chắc chắn muốn xóa màu sắc này?')"
                                            href="{{route('san-pham.xoa-mau-sac',$item->id)}}" class="btn btn-secondary btn-sm">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $mau_sacs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
