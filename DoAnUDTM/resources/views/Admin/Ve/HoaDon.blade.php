@extends('Admin.Home.index')
@section('content')
    <style type="text/css">
        .ghe {
            min-width: 100px;
        }
    </style>
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center>
                            <h4> Thêm Hóa ĐƠn Thành Công</h4>
                        </center>

                    </div>
                </div>

            </div>
            <div class="errorMessage">
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-validation">
                                <table class="table text-dark">
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="4">Chi Tiết Hóa Đơn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Mã hóa đơn</th>
                                            <td>{{ $hoaDon->MAHOADON }}</td>
                                            <td>--</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Người tạo</th>
                                            <td>{{ $hoaDon->nhanVien->HoTen }}</td>
                                            <td>--</td>
                                        </tr>
                                        @foreach ($hoaDon->chiTietVe ?? [] as $ctve)
                                            @if ($loop->first)
                                                <tr>
                                                    <th scope="row">Tên phim</th>
                                                    <td>{{ $ctve->ve->lichChieu->phim->TenPhim }}</td>
                                                    <td>--</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tên phòng</th>
                                                    <td>{{ $ctve->ve->lichChieu->phong->TenPhong }}</td>
                                                    <td>--</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Thời gian</th>
                                                    <td>{{ date_format(date_create($ctve->ve->lichChieu->ThoiGianChieu), 'H:i d-m-Y') }}
                                                    </td>
                                                    <td>{{ date_format(date_create($ctve->ve->lichChieu->ThoiGianKetThuc), 'H:i d-m-Y') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-center">Vé xem phim</th>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th scope="row">Mã ghê</th>
                                                <td>{{ $ctve->ve->MaGheNgoi }}</td>
                                                <td>Giá:{{ number_format($ctve->GiaVe, 0, '', '.') }} VND</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($hoaDon->chiTietThucAn ?? [] as $ctta)
                                            @if ($loop->first)
                                                <tr>
                                                    <th colspan="3" class="text-center">Đồ ăn</th>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>{{ $ctta->thucAn->TENTHUCAN }}</td>
                                                <td>{{ $ctta->SOLUONG }}</td>
                                                <td>Giá: {{ number_format($ctta->thucAn->DONGIA, 0, '', '.') }} VND</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th scope="row">Ghi chú</th>
                                            <td>{{ $hoaDon->GHICHU }}</td>
                                            <td>--</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tổng số lượng</th>
                                            <td>{{ $hoaDon->TONGSL }}</td>
                                            <td>--</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Thời gian tạo</th>
                                            <td>{{ date_format(date_create($hoaDon->NGAYTAO), 'H:i d-m-Y') }}</td>
                                            <td>--</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tổng tiền</th>
                                            <td class="text-danger font-weight-bold">{{ number_format($hoaDon->TONGTIEN, 0, '', '.') }} VND</td>
                                            <td>--</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
