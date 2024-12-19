@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách đã bị xóa</h1>
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
                    <form action="{{route('san-pham.danh-sach-san-pham-da-xoa')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kywSP" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body row">
                <div class="table-responsive col-12">
                    <div class="mb-4">
                        <h4>Danh sách sản phẩm</h4>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Mã loại</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá gốc</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($san_phams->count() > 0)
                                @foreach ($san_phams as $item)
                                    <tr>
                                        <td class="col-1 align-middle">SP-{{$item->id}}</td>
                                        <td class="col-2 align-middle"><img src="{{Storage::url($item->hinh_anh)}}" alt="err" height="60px"></td>
                                        <td class="col-3 align-middle">
                                            <a>{{$item->ten_san_pham}}</a>
                                        </td>
                                        <td class="col-2 align-middle">{{ number_format($item->gia_san_pham, 0, ',', '.') }} VND</td>
                                        <td class="col-3 align-middle text-center">
                                            <a onclick="return confirm('Bạn chắc chắn muốn khôi phục không?')"
                                                href="{{route('san-pham.khoi-phuc-san-pham',$item->id)}}"
                                                class="btn btn-success btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-undo"></i>
                                            </span>
                                            <span class="text">Khôi phục</span></a> |
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn không?')"
                                                href="{{route('san-pham.xoa-san-pham-vinh-vien',$item->id)}}"
                                                class="btn btn-danger btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Xóa Vĩnh Viễn</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $san_phams->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class=" float-right">
                    <form action="{{route('san-pham.danh-sach-san-pham-da-xoa')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kywBT" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body row">
                <div class="table-responsive col-12">
                    <div class="mb-4">
                        <h4>Danh sách biến thể</h4>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Mã loại</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Kích cỡ</th>
                                <th>Màu sắc</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($bien_thes->count()>0)
                                @foreach ($bien_thes as $item)
                                <tr>
                                    <td class="col-1 align-middle text-center">BT-{{$item->id}}</td>
                                    <td class="col-1 align-middle"><img src="{{Storage::url($item->hinh_anh)}}" alt="err" height="60px"></td>
                                    <td class="col-4 align-middle text-center"><a>{{$item->sanPham->ten_san_pham}}</a></td>
                                    <td class="col-1 align-middle text-center">{{$item->kich_co}}</td>
                                    <td class="col-1 text-center align-middle">
                                        <div class="color-circle" style="background-color: {{$item->ma_mau}};"></div>
                                    </td>
                                    <td class="col-3 align-middle text-center">
                                        <a onclick="return confirm('Bạn chắc chắn muốn khôi phục không?')"
                                            href="{{route('san-pham.khoi-phuc-bien-the',$item->id)}}"
                                            class="btn btn-success btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-undo"></i>
                                        </span>
                                        <span class="text">Khôi phục</span></a> |
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn không?')"
                                            href="{{route('san-pham.xoa-bien-the-vinh-vien',$item->id)}}"
                                            class="btn btn-danger btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Xóa Vĩnh Viễn</span></a>
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
    </div>
    <!-- /.container-fluid -->
@endsection
