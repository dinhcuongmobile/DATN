@extends('admin.layout.main')
@section('containerAdmin')
    <style>
        .contact-table {
            border: 1px solid #e3e6f0;
            width: 100%;
        }

        .contact-table th,
        .contact-table td {
            border: 1px solid #e3e6f0;
            padding: 12px;
        }

        .contact-table th {
            background-color: #f8f9fc;
            width: 200px;
            font-weight: bold;
        }

        .contact-card {
            border: 1px solid #e3e6f0;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-card .card-body {
            padding: 0;
        }
    </style>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Chi tiết đánh giá</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <a href="" class="btn btn-secondary btn-sm">Danh Sách Đã
                        Phản Hồi</a>
                    <a href="" class="btn btn-secondary btn-sm">Danh Sách
                        Chưa Phản Hồi</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('error'))
                        <div class="alert alert-danger" id="alert-message">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" id="alert-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    @php
                        $ratingStars =
                            str_repeat('<i class="fa-solid fa-star"></i>', $danhGia->so_sao) .
                            str_repeat('<i class="fa-regular fa-star"></i>', 5 - $danhGia->so_sao);
                    @endphp
                    <div class="contact-card">
                        <div class="card-body">
                            <table class="contact-table">
                                <tbody>
                                    <tr>
                                        <th>Họ & Tên</th>
                                        <td>{{ $danhGia->user->ho_va_ten }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <td>{{ $danhGia->donHang->ma_don_hang }}</td>
                                    </tr>
                                    <tr>
                                        <th>Thông tin sản phẩm</th>
                                        <td>
                                            <img src="{{ Storage::url($danhGia->sanPham->hinh_anh) }}" alt="lỗi"
                                                style="width: 100px; height: 100px;">
                                            {{ $danhGia->sanPham->ten_san_pham }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số sao</th>
                                        <td>{!! $ratingStars !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Nội dung</th>
                                        <td>
                                            {{ $danhGia->noi_dung }}
                                            <br>
                                            </br>
                                            @foreach ($danhGia->anhDanhGias as $item)
                                                <img src="{{ Storage::url($item->hinh_anh) }}" alt="lỗi"
                                                    style="width: 100px; height: 100px;">
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Trạng Thái</th>
                                        <td>
                                            <span class="{{ $danhGia->trang_thai == 0 ? 'text-danger' : 'text-success' }}">
                                                {{ $danhGia->trang_thai == 0 ? 'Chưa trả lời' : 'Đã trả lời' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ngày Gửi</th>
                                        <td>{{ $danhGia->created_at }}</td>
                                    </tr>
                                    @if ($danhGia->trang_thai == 1)
                                        <tr>
                                            <th>Ngày Phản Hồi</th>
                                            <td>{{ $danhGia->updated_at }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>Trả lời</th>
                                        <td>
                                            <form action="{{ route('danh-gia.tra-loi') }}" method="POST"
                                                style="display: inline;" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="danh_gia_id", value="{{ $danhGia->id }}">
                                                <textarea name="noi_dung" cols="170" rows="3" placeholder="Nhập câu trả lời..."></textarea>
                                                @error('noi_dung')
                                                    <p class="text-danger mt-1">{{ $message }}</p>
                                                @enderror
                                                <br>
                                                </br>
                                                @if ($danhGia->trang_thai == 0)
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Trả lời
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
