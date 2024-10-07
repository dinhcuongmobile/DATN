@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách sản phẩm đã bị xóa</h1>
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
                    <form action="#" method="GET">
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
                <form action="#" method="post">
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
                            <tr>
                                <td class="align-middle text-center"><input type="checkbox" name="select[]" id="" value="1"></td>
                                <td class="col-1 align-middle text-center">DCM-1</td>
                                <td class="col-1 align-middle"><img src="" alt="err" height="60px"></td>
                                <td class="col-2 align-middle">1</td>
                                <td class="col-2 align-middle">{{ number_format(1, 0, ',', '.') }} VND</td>
                                <td class="col-1 align-middle">1</td>
                                <td class="align-middle">1%</td>
                                <td class="col-1 align-middle">1</td>
                                <td class="col-3 align-middle text-center">
                                    <a onclick="return confirm('Bạn chắc chắn muốn khôi phục không?')"
                                        href="#"
                                        class="btn btn-success btn-sm">Khôi phục</a> |
                                    <a onclick="return confirm('Bạn chắc chắn muốn xóa không?')"
                                        href="#"
                                        class="btn btn-danger btn-sm">Xóa vĩnh viễn</a>
                                </td>
                            </tr>
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
