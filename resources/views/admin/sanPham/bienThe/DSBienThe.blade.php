@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách biến thể sản phẩm</h1>
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
                    <form action="{{route('san-pham.danh-sach-bien-the-san-pham')}}" method="GET">
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
                <form action="{{route('san-pham.xoa-nhieu-bien-the-san-pham')}}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Bạn chắc chắn muốn xóa các biến thể đã chọn?')"
                                type="submit" class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="{{route('san-pham.show-them-bien-the-san-pham')}}"><button type="button"
                                class="btn btn-secondary btn-sm">Nhập thêm</button></a>
                    </div>
            </div>
            <div class="card-body" id="table_sp">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th></th>
                                <th>Mã loại</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Kích cỡ</th>
                                <th>Màu sắc</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($bien_thes)>0)
                                @foreach ($bien_thes as $item)
                                <tr>
                                    <td class="align-middle text-center"><input type="checkbox" name="select[]" id="" value="{{$item->id}}"></td>
                                    <td class="col-1 align-middle text-center">BT-{{$item->id}}</td>
                                    <td class="col-1 align-middle"><img src="{{Storage::url($item->hinh_anh)}}" alt="err" height="60px"></td>
                                    <td class="col-4 align-middle"><a href="{{route('san-pham.san-pham-bien-the',$item->san_pham_id)}}">{{$item->sanPham->ten_san_pham}}</a></td>
                                    <td class="col-1 align-middle text-center">{{$item->so_luong}}</td>
                                    <td class="col-1 align-middle text-center">{{$item->kich_co}}</td>
                                    <td class="col-1 text-center align-middle">
                                        <div class="color-circle" style="background-color: {{$item->ma_mau}};"></div>
                                    </td>
                                    @if ($item->so_luong==0)
                                        <td class="col-1 align-middle text-danger text-center">Hết hàng</td>
                                    @else
                                        <td class="col-1 align-middle text-success text-center">Còn hàng</td>
                                    @endif
                                    <td class="text-center col-2 align-middle">
                                        <a href="{{route('san-pham.show-sua-bien-the-san-pham',$item->id)}}" class="btn btn-warning btn-sm">Sửa</a> |
                                        <a  onclick="return confirm('Bạn chắc chắn muốn xóa biến thể này?')"
                                            href="{{route('san-pham.xoa-bien-the-san-pham',$item->id)}}" class="btn btn-danger btn-sm">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $bien_thes->links() }}
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
