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
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="user-information">
                <div class="user-img">
                    <a href="#"> <img src="{{ asset('assets/Content/Upload/Image/' .$phim[0]->ApPhich) }}" alt=""></a>
                    <center> <h3 style="color: white">{{ $phim[0]->TenPhim }}</h3></center>
                    <ul>
                        <input type="hidden" value="{{ $phim[0]->DonGia }}" id="GiaPhim">
                        <input type="hidden" value="{{ $phim[0]->idPhim }}" id="idPhim">
                        <li class="active"><a>Năm Sản Xuất :{{ $phim[0]->NamSX }}</a></li>
                        <li><a>Thể Loại: {{ $phim[0]->TenTheLoai }}</a></li>
                        <li><a>Thời Lượng: {{ $phim[0]->ThoiLuong }}(phút)</a></li>
                    </ul>
                </div>
                <div class="user-fav" style="color: aliceblue">
                    
                        <label for=""><h4>Thông Tin vé</h4></label> <br>
                        <label for="">Tên Người Đặt : {{ Auth::user()->TenDangNhap }}</label><br>
                        <label for="">Danh Sách Ghế : <br><span id="thongtinve"></span></label>
                        <hr style="border: 1px solid black;">
                        <label for="">Danh Sách Thức Ăn : <br>
                        <span id="thucandachon" class="thucandachon">

                        </span>
                        </label>
                        <br>
                        <label for="" style="color: red">Tông Tiền: <span class="tongtien" id="tongtien"></span></label>
                 
                   
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="form-style-1 user-pro" action="#">
                <form action="/Ve/Create" class="user" method="get">
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
                        <div class="col-md-12 form-it" id="danhsachghe">

                        </div>
                        
                    </div>
                    <div class="row" >
                        <div class="col-md-12 form-it" id="danhsachthucan">
                            @foreach ($thucan as $item)
                                <div class="col-md-3 thucan" style="background-color: aqua">
                                    <input type="checkbox" class="chonThucAn" data-mathucan="{{ $item->MATHUCAN }}" data-gia="{{ $item->DONGIA }}">
                                    <h5 class="tenthucan">{{ $item->TENTHUCAN }}</h5>
                                    <p>{{ $item->DONGIA }}</p>
                                    <input type="hidden" class="mathucan" value="{{ $item->MATHUCAN }}">
                                    <input type="number" class="soluong" value="1">
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-7 form-it" id="hienthithucan">
                            <div class="col-md-6">
                                <label for="">Chọn Đồ Ăn</label>
                                <select id="selectDrink">
                                    <option value="1">Nước Ngọt</option>
                                    <option value="2">Cà Phê</option>
                                    <!-- Thêm các lựa chọn khác nếu cần -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <br>
                                <button id="addButton">Thêm</button>
                            </div>
                        </div> --}}
                        
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
     let gia=0; 
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
                                var giaghe=parseInt(document.getElementById('GiaPhim').value);
                                if (isSelected) {
                                    selectedSeats.push(this.innerHTML);
                                    gia+=giaghe;
                                } else {
                                    var index = selectedSeats.indexOf(this.innerHTML);
                                    if (index !== -1) {
                                        selectedSeats.splice(index, 1);
                                        gia-=giaghe;
                                    }
                                }
                                $('#thongtinve').text("");
                                $('#thongtinve').text(selectedSeats);
                                $('#tongtien').text("");
                                $('#tongtien').text(gia);
                                
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


     let danhSachThucAnDaChon = [];
        const tongTienElement = document.querySelector('.tongtien');

        function updateUI() {
            const thucAnDaChonElement = document.querySelector('.thucandachon');
            let tongTien = 0;

            thucAnDaChonElement.innerHTML = danhSachThucAnDaChon.map(item => {
                const itemTongTien = item.soLuong * item.gia;
                tongTien += itemTongTien;

                return `
                    <div>
                        <p>Tên thức ăn: ${item.tenThucAn}  X  ${item.soLuong}</p>
                    </div>
                `;
            }).join('');

            tongTienElement.textContent = tongTien+gia;

            const lisstdataoElement = document.querySelector('.lisstdatao');
            lisstdataoElement.innerHTML = danhSachThucAnDaChon.map(item => {
                const itemTongTien = item.soLuong * item.gia;

                return `
                    <div>
                        <p>Tên thức ăn: ${item.tenThucAn}  X  ${item.soLuong}</p>
                    </div>
                `;
            }).join('');
        }

        document.addEventListener('change', function(event) {
            if (event.target.classList.contains('chonThucAn')) {
                const selectedThucAn = event.target.closest('.thucan');
                const maThucAn = selectedThucAn.querySelector('.mathucan').value;
                const soLuong = selectedThucAn.querySelector('.soluong').value;
                const gia = selectedThucAn.querySelector('.chonThucAn').getAttribute('data-gia');
                const tenThucAn = selectedThucAn.querySelector('.tenthucan').innerText; 
                if (event.target.checked) {
                    danhSachThucAnDaChon.push({ maThucAn,tenThucAn, soLuong, gia: parseInt(gia) });
                } else {
                    danhSachThucAnDaChon = danhSachThucAnDaChon.filter(item => item.maThucAn !== maThucAn);
                }

                updateUI();
            }
        });

        document.addEventListener('input', function(event) {
            if (event.target.classList.contains('soluong')) {
                const selectedThucAn = event.target.closest('.thucan');
                const maThucAn = selectedThucAn.querySelector('.mathucan').value;
                const soLuong = event.target.value;

                const existingItemIndex = danhSachThucAnDaChon.findIndex(item => item.maThucAn === maThucAn);
                if (existingItemIndex !== -1) {
                    danhSachThucAnDaChon[existingItemIndex].soLuong = soLuong;
                }

                updateUI();
            }
        });
//         $('.datve').on('click', function(event) {
//     event.preventDefault();
//     let danhSachJSON = encodeURIComponent(JSON.stringify(danhSachThucAnDaChon));

//     // Chuyển đến trang mới với tham số truyền dữ liệu
//     window.location.href = '/new-page?danhSach=' + danhSachJSON;
// });
$('.datve').on('click', function(event) {
        event.preventDefault();
        let danhSachJSON = encodeURIComponent(JSON.stringify(danhSachThucAnDaChon));
        $.ajax({
             url: '/phim/taohoadon/' + selectedSeats + '/' + secondNumber+'/new-page?danhSach=' + danhSachJSON,
             type: 'GET',
             dataType: 'json',
             success: function(data) {
                var mahoadon=data.msg;
                console.log(mahoadon);
                window.location.href = '/chitietdatve/'+mahoadon;
             }
         });
    });
    
 });
 
 </script>


@endsection


