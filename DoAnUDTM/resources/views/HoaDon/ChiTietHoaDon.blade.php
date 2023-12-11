@extends('Home.Main')
@section('content')
    <style>
        td,
        th {
            color: aliceblue;
        }
    </style>
    <div class="hero user-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Trang Thông Tin Đặt Vé</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">Home</a></li>
                            <li> <span class="ion-ios-arrow-right"></span>Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-single">
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="row ipad-width">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-style-1 user-pro" action="#">

                        <h4>Đặt Vé Xem Phim</h4>

                        <div class="row">

                            <div class="col-md-12 form-it">
                                <label for="">
                                    <h4>Thông Tin vé</h4>
                                </label> <br>
                                <label for="">Tên Người Đặt : {{ Auth::user()->TenDangNhap }}</label><br>
                                <table>
                                    <thead>
                                        <th>
                                            Mã Vé
                                        </th>
                                        <th>
                                            Mã Ghế Ngồi
                                        </th>
                                        <th>
                                            Đơn Giá
                                        </th>
                                    </thead>
                                    <tbody>

                                        @foreach ($hoadon as $item)
                                            <tr>
                                                <td>{{ $item->idVe }}</td>
                                                <td>
                                                    {{ $item->MaGheNgoi }}
                                                </td>
                                                <td>
                                                    {{ $item->GiaVe }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr style="border: 1px solid black;">

                                <label for="">Tông Tiền: <span
                                        id="tongtien">{{ $hoadon[0]->TONGTIEN }}</span></label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <input type="hidden" class="mahoadon" id="mahoadon" value="{{ $hoadon[0]->MAHOADON }}">
                                <a href="{{ route('make.payment', ['idHD' => $hoadon[0]->MAHOADON]) }}"
                                    class="datve {{ $hoadon[0]->TRANGTHAI == 1 ? 'disabled' : '' }}">
                                    Thanh Toán
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .datve {
            margin-top: 10px;
            font-family: 'Dosis', sans-serif;
            font-size: 14px;
            color: #ffffff !important;
            font-weight: bold;
            text-transform: uppercase;
            background: #dd003f;
            height: 40px;
            width: 100px;
            padding: 12px 30px;
            border-radius: 50px !important;
        }

        .datve.disabled {
            opacity: 0.2;
            cursor: auto;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.datve').on('click', function(event) {
                if ($('.datve').hasClass('disabled')) {
                    event.preventDefault();
                }
            });

        });
    </script>
@endsection
