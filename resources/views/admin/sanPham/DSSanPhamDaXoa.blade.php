@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách sản phẩm đã bị xóa ({{$san_phams->count()}})</h1>
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
                            <input type="text" class="form-control" name="kyw" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <form action="{{route('san-pham.xoa-nhieu-san-pham-vinh-vien')}}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn không?')" type="submit"
                            class="btn btn-secondary btn-sm">Xóa vĩnh viễn các mục đã chọn</button>
                    </div>
            </div>
            <div class="card-body">
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
                            </tr>
                        </thead>
                        <tbody>
                            @if ($san_phams->count() > 0)
                                @foreach ($san_phams as $item)
                                    <tr>
                                        <td class="align-middle text-center"><input type="checkbox" name="select[]" id="" value="{{$item->id}}"></td>
                                        <td class="col-1 align-middle text-center">SP-{{$item->id}}</td>
                                        <td class="col-1 align-middle"><img src="{{Storage::url($item->hinh_anh)}}" alt="err" height="60px"></td>
                                        <td class="col-2 align-middle">{{$item->ten_san_pham}}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->gia_san_pham, 0, ',', '.') }} VND</td>
                                        <td class="col-1 align-middle">{{$item->tong_so_luong}}</td>
                                        <td class="align-middle">{{$item->khuyen_mai}}%</td>
                                        <td class="col-1 align-middle">{{$item->danhMuc->ten_danh_muc}}</td>
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
