@extends('Home.Main')
@section('content')
<div class="hero user-hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hero-ct">
                    <h1>Trang Đặt Vé</h1>
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
    <div class="row ipad-width">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="user-information">
                <div class="user-img">
                    <a href="#"> <img src="{{ asset('assets/Content/Upload/Image/' .$phim[0]->ApPhich) }}" alt=""></a>
                </div>
                <div class="user-fav">
                    <h3 style="color: white">{{ $phim[0]->TenPhim }}</h3>
                    <ul>
                        <input type="hidden" value="{{ $phim[0]->idPhim }}" id="idPhim">
                        <li class="active"><a>Năm Sản Xuất :{{ $phim[0]->NamSX }}</a></li>
                        <li><a>Thể Loại: {{ $phim[0]->TenTheLoai }}</a></li>
                        <li><a>Thời Lượng: {{ $phim[0]->ThoiLuong }}(phút)</a></li>
                        <li><a>Đạo Diễn: {{ $phim[0]->DaoDien }} </a></li>
                        <li><a>Ngày Khởi Chiếu: {{ $phim[0]->NgayKhoiChieu }} </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="form-style-1 user-pro" action="#">
                <form action="" class="user" method="get">
                    <h4>Đặt Vé Xem Phim</h4>

                    <div class="row">
                        <div class="col-md-6 form-it">
                            <label>Ngày Chiếu</label>
                            <select name="ngaychieu" id="ngaychieu">
                                <option value="0">__Chọn Ngày Chiếu__</option>
                                @foreach ($lichchieu as $item)
                                    <option value="{{ $item->NgayChieu }}">Ngày: {{ $item->NgayChieu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-it">
                            <label>Giờ Chiếu</label>
                            <select name="giochieu" id="giochieu">
                                <option value="0">__Chọn Giờ__</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" >
                        {{-- chỗ này là xuất ghế --}}
                        <div class="col-md-8 form-it" id="danhsachghe">

                        </div>
                        <div class="col-md-4 form-it" >
                            <label for="">Thông Tin vé</label>
                            <label for="">Ghế : <span id="thongtinve"></span></label>
                        </div>
                    </div>
                    <div class="row" >

                    </div>
                    <div class="row">
                        <div class="col-md-6 form-it">
                            <label>Thanh Toán </label>
                            <div class="radio">
                                <label><input type="radio" name="payment" value="offline" checked>Thanh Toán Toán Tại Quẩy</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="payment" value="online">Thanh Toán MoMo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input class="submit datve" type="submit" value="Đặt vé">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
     document.getElementById('ngaychieu').addEventListener('change', function() {
         let ngay = this.value;
         let idPhim = document.getElementById('idPhim').value;


         $.ajax({
             url: '/phim/lichchieu/' + idPhim + '/' + ngay,
             type: 'GET',
             dataType: 'json',
             success: function(data) {
                 let danhmucs = data.xuatchieu;
                 let danhmucList = $('#giochieu');
                 danhmucList.html("");
                 danhmucList.append(`<option value="0">__Chọn Ngày Chiếu__</option>`);
                 danhmucs.forEach(function(phim) {
                     danhmucList.append(`<option value="`+phim.idPhong+`,`+phim.idLichChieu+`">Giờ : `+phim.ThoiGianChieu+`->`+phim.ThoiGianKetThuc+`</option>`);
                 });
             }
         });
     });

     let selectedSeats = [];
     let firstNumber=0;
     let secondNumber=0;
     document.getElementById('giochieu').addEventListener('change', function() {
         let idphongxuatchieu = this.value;
         let numbers = idphongxuatchieu.split(',');
         firstNumber= parseInt(numbers[0]);
         secondNumber = parseInt(numbers[1]);
         $.ajax({
             url: '/phim/danhsachghe/' + firstNumber + '/' + secondNumber,
             type: 'GET',
             dataType: 'json',
             success: function(data) {
                var gheContainer = document.getElementById('danhsachghe');
                var m = data.soHangGhe; // Số hàng
                var n = data.soGheMotHang; // Số ghế mỗi hàng
                var dsghedaco = data.magheArray;
                var dem = 0;


                for (var i = 1; i <= m; i++) {
                    var hangGhe = document.createElement('li');
                    hangGhe.classList.add('hang-ghe');

                    for (var j = 1; j <= n; j++) {
                        var ghe = document.createElement('li');
                        var gheValue = "P" + firstNumber + "LC" + secondNumber + "V" + dem; // Giá trị hiển thị
                        ghe.innerHTML = gheValue;
                        ghe.value = gheValue; // Giá trị value

                        ghe.classList.add('ghe');

                        // Kiểm tra xem phần tử có nằm trong mảng dsghedaco hay không
                        if (dsghedaco.indexOf(gheValue) !== -1) {
                            ghe.classList.add('ghe-da-co');
                            ghe.disabled = true;
                        } else {
                            ghe.addEventListener('click', function() {
                                var isSelected = this.classList.toggle('ghe-chon');

                                if (isSelected) {
                                    selectedSeats.push(this.innerHTML);

                                } else {
                                    var index = selectedSeats.indexOf(this.innerHTML);
                                    if (index !== -1) {
                                        selectedSeats.splice(index, 1);
                                    }
                                }
                                $('#thongtinve').text("");
                                $('#thongtinve').text(selectedSeats);

                            });
                        }

                        hangGhe.appendChild(ghe);
                        dem++;
                    }

                    gheContainer.appendChild(hangGhe);

                }
            }
         });

     });
     $('.datve').on('click', function(event) {
        event.preventDefault();
        $.ajax({
             url: '/phim/taohoadon/' + selectedSeats + '/' + secondNumber,
             type: 'GET',
             dataType: 'json',
             success: function(data) {
                 alert("thanhcong");
             }
         });
    });

 });

 </script>

@endsection


