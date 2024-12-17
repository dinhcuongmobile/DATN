@extends('admin.layout.main')
@section('containerAdmin')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách đánh giá chưa phản hồi ({{$danhGias->count()}})</h1>
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
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kyw"
                                placeholder="Tìm kiếm theo Họ và Tên...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <form action="{{ route('danh-gia.an-nhieu') }}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Bạn chắc chắn muốn ẩn các mục đã chọn?')" type="submit"
                            class="btn btn-secondary btn-sm">Ẩn các mục đã chọn</button>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Họ và Tên</th>
                                <th>Sản phẩm</th>
                                <th>Nội dung</th>
                                <th>Số sao</th>
                                <th>Trạng thái</th>
                                <th>Ngày gửi</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($danhGias->count() > 0)
                                @foreach ($danhGias as $item)
                                    @if ($item->noi_dung != null)
                                        @php
                                            $ratingStars =
                                                str_repeat('<i class="fa-solid fa-star"></i>', $item->so_sao) .
                                                str_repeat('<i class="fa-regular fa-star"></i>', 5 - $item->so_sao);
                                        @endphp
                                        <tr>
                                            <td class="text-center align-middle"><input type="checkbox" name="select[]"
                                                    value="{{ $item->id }}"></td>
                                            <td class="col-2 align-middle">{{ $item->user->ho_va_ten }}</td>
                                            <td class="col-3 align-middle">
                                                <a
                                                    href="{{ route('san-pham.san-pham-bien-the', $item->san_pham_id) }}">{{ $item->sanPham->ten_san_pham }}</a>
                                            </td>
                                            <td class="col-3 align-middle">{{ $item->noi_dung }}</td>
                                            <td class="col-1 align-middle">{!! $ratingStars !!}</td>
                                            <td
                                                class="col-1 align-middle {{ $item->trang_thai == 0 ? 'text-danger' : 'text-success' }}">
                                                {{ $item->trang_thai == 0 ? 'Chưa trả lời' : 'Đã trả lời' }}</td>
                                            <td class="col-1 align-middle">{{ $item->created_at }}</td>
                                            <td class="col-2 align-middle">
                                                <a href="{{ route('danh-gia.chi-tiet', $item->id) }}">
                                                    <button type="button" class="btn btn-primary btn-sm mb-3">Chi tiết</button>
                                                </a>
                                                <a href="{{ route('danh-gia.an', $item->id) }}">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Xác nhận ẩn đánh giá !')">Ẩn ngay</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Không có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
