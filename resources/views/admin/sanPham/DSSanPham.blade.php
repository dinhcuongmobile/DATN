@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách sản phẩm</h1>
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
                    <form action="{{route('san-pham.danh-sach')}}" method="GET">
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
                <form action="{{route('san-pham.xoa-nhieu-san-pham')}}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button  onclick="return confirm('Bạn chắc chắn muốn chuyển các mục đã chọn vào thùng rác?')"
                                type="submit" class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="{{route('san-pham.show-them-san-pham')}}"><button type="button"
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
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá gốc</th>
                                <th>Số lượng</th>
                                <th>Khuyến mãi</th>
                                <th>Danh mục</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($san_phams)>0)
                                @foreach ($san_phams as $item)
                                    <tr>
                                        <td class="align-middle text-center"><input type="checkbox" name="select[]" id="" value="{{$item->id}}"></td>
                                        <td class="col-1 align-middle text-center">SP-{{$item->id}}</td>
                                        <td class="col-1 align-middle"><img src="{{Storage::url($item->hinh_anh)}}" alt="err" height="60px"></td>
                                        <td class="col-2 align-middle">{{$item->ten_san_pham}}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->gia_san_pham, 0, ',', '.') }} VND</td>
                                        <td class=" align-middle">{{$item->tong_so_luong}}</td>
                                        <td class="align-middle">{{$item->khuyen_mai}}%</td>
                                        <td class="col-1 align-middle"><a href="{{route('san-pham.danh-sach-danh-muc-san-pham',$item->danh_muc_id)}}">{{$item->danhMuc->ten_danh_muc}}</a></td>
                                        <td class="text-center col-2 align-middle">
                                            <a href="{{route('san-pham.show-sua-san-pham',$item->id)}}" class="btn btn-secondary btn-sm">Sửa</a> |
                                            <a   onclick="return confirm('Bạn chắc chắn muốn chuyển vào thùng rác?')"
                                                href="{{route('san-pham.xoa-san-pham',$item->id)}}" class="btn btn-secondary btn-sm">Xóa</a>
                                        </td>
                                        <td class="text-center align-middle" id="hover_icon_sp">
                                            <i id="icon_sp" class="fa-solid fa-arrow-right"></i>
                                            <div class="hidden-links">
                                                <a href="{{route('san-pham.bien-the-san-pham',$item->id)}}" class="btn-sp">Biến thể</a>
                                                <a href="{{route('san-pham.khuyen-mai-san-pham',$item->id)}}" class="btn-sp">Mã giảm giá</a>
                                            </div>
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
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
