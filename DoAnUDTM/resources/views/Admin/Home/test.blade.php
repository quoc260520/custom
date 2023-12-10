@extends('Admin.Home.index')
@section('content')
    
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center><h4>Quản Lý Lịch Chiếu</h4></center>
                        
                    </div>
                </div>
               
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('get_create_lichchieu') }}">Thêm Lịch Chiếu </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTables-lichchieu" class="display" style="width: 1360px;color:black;">
                                    <thead>
                                        <tr>
                                            <th>Mã Lịch Chiếu</th>
                                            <th>Thời Gian Chiếu</th>
                                            <th>Thời Gian Kết Thúc</th>
                                            <th>Tên Phòng Chiếu</th>    
                                            <th>Tên Phim</th>                              
                                            <th>#</th>
                                            <th>#</th>
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
    
    
    
    
@endsection
@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Thêm Lịch Chiếu</h4></center>
                  
                </div>
            </div>
            
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                   
                    <div class="card-body">
                        <div class="form-validation">
                            
                            <form id="create-phim-form" method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                
                               
                                <div class="form-group">
                                    <label class="col-md-2" for="">Ngày Chiếu </label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="date" id="NgayChieu" value="" name="NgayChieu" placeholder="Ngày Chiếu">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="">Giờ Chiếu </label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="time" id="GioChieu" value="" name="GioChieu" placeholder="Giờ Chiếu">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="">Chọn Phim</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="mySelect" name="idManHinh">
                                            {{-- @foreach ($loaimanhinh as $item)
                                                <option value="{{ $item->idMH }}">{{ $item->TenMH }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Số Ghế Một Hàng</label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="" width="162" height="240" alt="">  
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Tên Phim</label><br>
                                                <label for="">Thời Lượng</label><br>
                                                <label for="">Ngày khởi Chiếu</label><br>
                                                <label for="">Thể Loại Phim</label><br>
                                                <label for="">Định Dạng Phim</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="container">
                                                    <center><h3>Danh Sách Lịch Chiếu Phim : <span style="color: red">Bảy Viên Ngọc Rồng</span> </h3></center> <br>
                                                <label for="">Ngày Chiếu : 2023-12-22  Giờ Chiếu : 12:00->14:00 Phòng Chiếu : PC01</label>
                                                <label for="">Ngày Chiếu : 2023-12-22  Giờ Chiếu : 12:00->14:00 Phòng Chiếu : PC01</label>
                                                <label for="">Ngày Chiếu : 2023-12-22  Giờ Chiếu : 12:00->14:00 Phòng Chiếu : PC01</label>
                                                <label for="">Ngày Chiếu : 2023-12-22  Giờ Chiếu : 12:00->14:00 Phòng Chiếu : PC01</label>
                                                <label for="">Ngày Chiếu : 2023-12-22  Giờ Chiếu : 12:00->14:00 Phòng Chiếu : PC01</label>
                                                <label for="">Ngày Chiếu : 2023-12-22  Giờ Chiếu : 12:00->14:00 Phòng Chiếu : PC01</label>
                                                <label for="">Ngày Chiếu : 2023-12-22  Giờ Chiếu : 12:00->14:00 Phòng Chiếu : PC01</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Chọn Phòng</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="mySelect" name="idTinhTrang">
                                            {{-- @foreach ($tinhtrang as $item)
                                                <option value="{{ $item->idTinhTrangPhongChieu }}">{{ $item->TinhTrang }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                <button type="submit">Thêm</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#create-phim-form').on('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('create_phongchieu') }}",
                type: 'POST',
                data: formData,
                processData: false, // Ngăn xử lý dữ liệu gửi đi
                contentType: false, // Không thiết lập kiểu dữ liệu
                success: function(res) {
                    console.log(res);
                    alert(res.message);
                    window.location.href = document.referrer;
                },error:function(er)
                    {
                        let err=er.responseJSON;
                        $.each(err.errors,function(index,value){
                            $('.errorMessage').append('<span class="text-danger">'+value+'</span><br/>  ')
                        });
                    }
            });
        });
    });
</script>
@endsection