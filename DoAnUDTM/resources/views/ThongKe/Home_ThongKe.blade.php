@extends('Admin.Home.index')
@section('content')
    
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center><h4>Trang Thống Kê</h4></center>
                        
                    </div>
                </div>
               
            </div>
            <!-- row -->
            <div class="row">
                @foreach ($phimhot as $item)
                    <div class="form-group" style="background-color: cadetblue">
                    
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('assets/Image/' . $item->ApPhich) }}" width="220" height="300" alt="">  
                                    <br>
                                    <label for="">{{ $item->TenPhim }}</label>
                                    <br>
                                    <label for="">Số Vé Đã Bán: {{ $item->SoLuongVeBan }}</label>
                                    <br>
                                    <label for="">Tổng Doanh Thu: {{ $item->TongTienBanDuoc }}</label>
                                </div>
                            </div>
                        </div>  
                    </div>
                @endforeach
                
                
                <div class="col-12">
                    <div class="card">
                   
                       <div class="row">
                            <div class="form-group col-3">
                                <label class="col-md-4" for="TenPhim">Chọn Phim</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="idPhim" name="idPhim">
                                        <option value="0">______Chọn Phim______</option>
                                        @foreach ($phim as $item)
                                            <option value="{{ $item->idPhim }}">{{ $item->TenPhim }}</option>
                                        @endforeach  
                                    </select>
                                
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label class="col-md-5" for="TenPhim">Chọn Nhân Viên</label>
                                <div class="col-md-7">
                                    <select class="form-control" id="idNhanVien" name="idNhanVien">
                                        <option value="0">___Chọn Nhân Viên___</option>
                                        @foreach ($nhanvien as $item)
                                            <option value="{{ $item->idNhanVien }}">{{ $item->HoTen }}</option>
                                        @endforeach
                                  
                                    </select>
                                
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label class="col-md-5" for="TenPhim">Ngày Bắt Đầu</label>
                                <div class="col-md-7">
                                    <input class="form-control text-box single-line" type="date" id="NgayBatDau" value="" name="NgayBatDau" placeholder="Ngày Bắt Đầu">
                                
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label class="col-md-5" for="TenPhim">Ngày Kết Thúc</label>
                                <div class="col-md-7">
                                    <input class="form-control text-box single-line" type="date" id="NgayKetThuc" value="" name="NgayKetThuc" placeholder="Ngày Kết Thúc">
                                
                                </div>
                            </div>
                       </div>
                        <hr style="color: black;">
                        <h3 style="color: red">Tổng Doanh Thu: <span id="tongtien"></span></h3>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTables-thongke" class="table" style="width: 1360px;color:black;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Mã Hóa Đơn</th>
                                            <th>Mã Khách Hàng</th>
                                            <th>Mã Nhân Viên</th>
                                            <th>Ngày Tạo</th>     
                                            <th>Tổng Số Lượng</th>
                                            <th>Tổng Tiền</th>    
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function clearTableData() {
                $('#dataTables-thongke tbody').empty();
            }
            function clearTongtien(){
                $('#tongtien').empty();
            }
            document.getElementById('idPhim').addEventListener('change', function() {
                let maphim = this.value;
                clearTableData();
                clearTongtien();
                $.ajax({
                    url: 'api/phim/layhoadontheophim/' +maphim,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var table = $('#dataTables-thongke tbody');
                        data.hoadon.forEach(function (item) {

                            table.append('<tr><td>' + item.MAHOADON + '</td><td>' + item.MAKHACHHANG + '</td><td>'+item.MANHANVIEN+'</td><td>'+item.NGAYTAO+'</td><td>'+item.TONGSL+'</td><td>'+item.TONGTIEN+'</td></tr>');
                            // Thêm các cột dữ liệu khác tương tự như trên (tùy thuộc vào cấu trúc dữ liệu trả về)
                        });
                        var tongtien=$('#tongtien');
                        tongtien.append(data.tongtien);
                    }
                });
            });
            document.getElementById('idNhanVien').addEventListener('change', function() {
                let maphim = this.value;
                clearTableData();
                clearTongtien();
                $.ajax({
                    url: 'api/phim/layhoadontheonhanvien/' +maphim,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var table = $('#dataTables-thongke tbody');
                        data.hoadon.forEach(function (item) {

                            table.append('<tr><td>' + item.MAHOADON + '</td><td>' + item.MAKHACHHANG + '</td><td>'+item.MANHANVIEN+'</td><td>'+item.NGAYTAO+'</td><td>'+item.TONGSL+'</td><td>'+item.TONGTIEN+'</td></tr>');
                            // Thêm các cột dữ liệu khác tương tự như trên (tùy thuộc vào cấu trúc dữ liệu trả về)
                        });
                        var tongtien=$('#tongtien');
                        console.log(data.tongtien);
                        tongtien.append(data.tongtien.TotalAmount);
                    }
                });
            });




            var currentDate = new Date();

            var firstDayOfMonth = new Date('2023-12-01');
            var formattedFirstDay = firstDayOfMonth.toISOString().slice(0, 10);

            // Lấy ngày hiện tại
            var formattedCurrentDate = currentDate.toISOString().slice(0, 10);

            // Gán giá trị cho các thẻ input
            document.getElementById('NgayBatDau').value = formattedFirstDay;
            document.getElementById('NgayKetThuc').value = formattedCurrentDate;
            
            getdata();
            
            document.getElementById('NgayKetThuc').addEventListener('change', function() {
                let tgbd = document.getElementById('NgayBatDau').value;
                let tkt =this.value;
                clearTableData();
                clearTongtien();
                $.ajax({
                    url: 'api/phim/layhoadontheokhoangthoigian/' +tgbd+'/'+tkt,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var table = $('#dataTables-thongke tbody');
                        data.hoadon.forEach(function (item) {

                            table.append('<tr><td>' + item.MAHOADON + '</td><td>' + item.MAKHACHHANG + '</td><td>'+item.MANHANVIEN+'</td><td>'+item.NGAYTAO+'</td><td>'+item.TONGSL+'</td><td>'+item.TONGTIEN+'</td></tr>');
                            // Thêm các cột dữ liệu khác tương tự như trên (tùy thuộc vào cấu trúc dữ liệu trả về)
                        });
                        var tongtien=$('#tongtien');
                        console.log(data.tongtien);
                        tongtien.append(data.tongtien);
                    }
                });
            });
            document.getElementById('NgayBatDau').addEventListener('change', function() {
                let tkt = document.getElementById('NgayKetThuc').value;
                let tgbd =this.value;
                clearTableData();
                clearTongtien();
                $.ajax({
                    url: 'api/phim/layhoadontheokhoangthoigian/' +tgbd+'/'+tkt,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var table = $('#dataTables-thongke tbody');
                        data.hoadon.forEach(function (item) {

                            table.append('<tr><td>' + item.MAHOADON + '</td><td>' + item.MAKHACHHANG + '</td><td>'+item.MANHANVIEN+'</td><td>'+item.NGAYTAO+'</td><td>'+item.TONGSL+'</td><td>'+item.TONGTIEN+'</td></tr>');
                            // Thêm các cột dữ liệu khác tương tự như trên (tùy thuộc vào cấu trúc dữ liệu trả về)
                        });
                        var tongtien=$('#tongtien');
                        console.log(data.tongtien);
                        tongtien.append(data.tongtien);
                    }
                });
            });
            function getdata()
            {
                clearTableData();
                clearTongtien();
                let tgbd = document.getElementById('NgayBatDau').value;
                let tkt = document.getElementById('NgayKetThuc').value;
                $.ajax({
                    url: 'api/phim/layhoadontheokhoangthoigian/' +tgbd+'/'+tkt,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var table = $('#dataTables-thongke tbody');
                        data.hoadon.forEach(function (item) {

                            table.append('<tr><td>' + item.MAHOADON + '</td><td>' + item.MAKHACHHANG + '</td><td>'+item.MANHANVIEN+'</td><td>'+item.NGAYTAO+'</td><td>'+item.TONGSL+'</td><td>'+item.TONGTIEN+'</td></tr>');
                            // Thêm các cột dữ liệu khác tương tự như trên (tùy thuộc vào cấu trúc dữ liệu trả về)
                        });
                        var tongtien=$('#tongtien');
                        console.log(data.tongtien);
                        tongtien.append(data.tongtien);
                    }
                });
            }

        });
    </script>
@endsection