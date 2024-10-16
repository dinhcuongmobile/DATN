@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách khuyến mại sản phẩm</h1>
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
                <div class=" float-right">
                    <form action="{{route('san-pham.danh-sach-ma-khuyen-mai')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kyw" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <form action="{{route('san-pham.xoa-nhieu-ma-khuyen-mai')}}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Bạn chắc chắn muốn xóa các mã khuyến mại này?')"
                        type="submit" class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="{{route('san-pham.show-them-ma-khuyen-mai')}}"><button type="button"
                                class="btn btn-secondary btn-sm">Nhập thêm</button></a>
                    </div>
            </div>
            <div class="card-body" id="table_sp">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th></th>
                                <th>Tên sản phẩm</th>
                                <th>Mã giảm giá</th>
                                <th>Số tiền giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Giá trị tối thiểu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($ma_khuyen_mais)>0)
                                @foreach ($ma_khuyen_mais as $item)
                                    <tr>
                                        <td class="align-middle text-center"><input type="checkbox" name="select[]" id="" value="{{$item->id}}"></td>
                                        <td class="col-2 align-middle"><a href="{{route('san-pham.san-pham-ma-khuyen-mai',$item->san_pham_id)}}">{{$item->sanPham->ten_san_pham}}</a></td>
                                        <td class="col-1 align-middle text-danger">{{$item->ma_giam_gia}}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->so_tien_giam, 0, ',', '.') }} VND</td>
                                        <td class="align-middle">{{$item->ngay_bat_dau}}</td>
                                        <td class="align-middle">{{$item->ngay_ket_thuc}}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->gia_tri_toi_thieu, 0, ',', '.') }} VND</td>
                                        <td class="text-center col-2 align-middle">
                                            <a href="{{route('san-pham.show-sua-ma-khuyen-mai',$item->id)}}" class="btn btn-secondary btn-sm">Sửa</a> |
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa mã khuyến mại này?')"
                                            href="{{route('san-pham.xoa-ma-khuyen-mai',$item->id)}}" class="btn btn-secondary btn-sm">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                    {{-- <div class="phantrang">
                        {{ $DSSanPham->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
