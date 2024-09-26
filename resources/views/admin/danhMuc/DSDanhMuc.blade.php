@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách danh mục</h1>
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
                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" type="submit"
                            class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="#" class="btn btn-secondary btn-sm">Nhập thêm</a>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Mã loại</th>
                                <th>Tên danh mục</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-1 text-center"><input type="checkbox" name="select[]" value="1"></td>
                                <td class="col-2">DM-1</td>
                                <td>1</td>
                                <td class="col-2">
                                    <a href="#" class="btn btn-secondary btn-sm">Sửa</a> |
                                    <a onclick="return confirm('Bạn chắc chắn muốn xóa không?')" href="#" class="btn btn-secondary btn-sm">Xóa</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <div class="phantrang">
                        {{ $DSDanhmuc->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
