@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Thêm Phòng</h4></center>
                  
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
                                
                                <input type="hidden" id="" value="" name="idPhongChieu" placeholder="Mã Phòng">
                                <div class="form-group">
                                    <label class="col-md-2" for="">Tên Phòng </label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="TenPhong" value="" name="TenPhong" placeholder="Tên Phòng">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="">Màn Hình </label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="mySelect" name="idManHinh">
                                            @foreach ($loaimanhinh as $item)
                                                <option value="{{ $item->idMH }}">{{ $item->TenMH }}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Số Hàng Ghế</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="number" id="SoHangGhe" value="" name="SoHangGhe" placeholder="Số Hàng Ghế">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Số Ghế Một Hàng</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="number" id="SoGheMotHang" value="" name="SoGheMotHang" placeholder="Số Ghế Một Hàng">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Trạng Thái Phòng</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="mySelect" name="idTinhTrang">
                                            @foreach ($tinhtrang as $item)
                                                <option value="{{ $item->idTinhTrangPhongChieu }}">{{ $item->TinhTrang }}</option>
                                            @endforeach
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