@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Thêm Phim</h4></center>
                  
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
                                
                                <input type="hidden" id="idPhim" value="" name="idPhim" placeholder="Mã Phim">
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Tên Phim</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="TenPhim" value="" name="TenPhim" placeholder="Tên Phim">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Mô Tả</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <textarea cols="170"  id="MoTa" name="MoTa" rows="7"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Thời Lượng</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="number" id="ThoiLuong" value="" name="ThoiLuong" placeholder="Thời Lượng">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Ngày Khởi Chiếu</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="date" id="NgayKhoiChieu" value="" name="NgayKhoiChieu" placeholder="Ngày Khởi Chiếu">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Hãng Sản Xuất</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="HangSanXuat" value="" name="HangSanXuat" placeholder="Hãng Sản Xuất">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Đạo Diễn</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="DaoDien" value="" name="DaoDien" placeholder="Đạo Diễn">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Link Trailer</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="Trailerr" value="" name="Trailerr" placeholder="link Trailer">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Năm Sản Xuất</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="number" id="NamSX" value="" name="NamSX" placeholder="Năm Sản Xuất">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Chọn Ảnh</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="file" id="anh" value="" name="anh">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Chọn Thể Loại</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="mySelect" name="idTheLoai">
                                            @foreach ($theloai as $item)
                                                <option value="{{ $item->idTheLoai }}">{{ $item->TenTheLoai }}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Chọn Định Dạng Phim</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="mySelect" name="idMH">
                                            @foreach ($dinhdang as $item)
                                                <option value="{{ $item->idMH }}">{{ $item->TenMH }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Đơn Giá</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="number" id="DonGia" value="" name="DonGia" placeholder="Nhập Giá">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Thêm</button>
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
                url: "{{ route('create_phim') }}",
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