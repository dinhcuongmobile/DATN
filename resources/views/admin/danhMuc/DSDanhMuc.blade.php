@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách danh mục</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class=" float-right">
                    <form action="{{ route('admin.danhMuc.DSDanhMuc')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kyw" placeholder="Tìm kiếm..." value="{{ request('kyw') }}">
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
                     
                        <a href="{{route('admin.danhMuc.create')}}" class="btn btn-secondary btn-sm">Nhập thêm</a>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Chọn</th>
                                <th>Mã Loại</th>
                                <th>Hình ảnh</th>
                                <th>Tên danh mục</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($danhMucs as $danhMuc)
                            <tr>
                                <td class="col-1 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $danhMuc->id }}">
                                </td>
                                <td class="col-2">NM-{{$danhMuc->id}}</td>
                                <td><img src="{{ asset('storage/' . $danhMuc->hinh_anh) }}" alt="{{ $danhMuc->ten_danh_muc }}" width="100"></td>
                                <td>{{ $danhMuc->ten_danh_muc }}</td>
                                <td class="col-2">
                                    <a href="{{ route('admin.danhMuc.edit', $danhMuc->id) }}" class="btn btn-warning btn-sm">Sửa</a> |
                                    <form action="{{ route('admin.danhMuc.destroy', $danhMuc->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Bạn chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="phantrang">
                        {{ $danhMucs->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
