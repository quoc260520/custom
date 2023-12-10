@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Sửa Nhân Viên</h4></center>
                  
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
                                
                                <input type="hidden" id="" value="{{ $nhanvien[0]->idNhanVien }}" name="idNhanVien" placeholder="Mã Nhân Viên">
                                <br>
                                
                                <center><h3>Thông Tin Nhân Viên</h3></center>
                                <div class="form-group">
                                    <label class="col-md-2" for="">Tên Nhân Viên </label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="HoTen" value="{{ $nhanvien[0]->HoTen }}" name="HoTen" placeholder="Tên Nhân Viên">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Ngày Sinh</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="date" id="NgaySinh" value="{{$nhanvien[0]->NgaySinh}}" name="NgaySinh" placeholder="Ngày Sinh">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Số Điện Thoại</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="SDT" value="{{ $nhanvien[0]->SDT }}" name="SDT" placeholder="Số Điện Thoại">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Địa Chỉ</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="DiaChi" value="{{$nhanvien[0]->DiaChi}}" name="DiaChi" placeholder="Địa Chỉ">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Email</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="Email" value="{{ $nhanvien[0]->Email }}" name="Email" placeholder="Nhập Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Chọn Chức Vụ</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="mySelect" name="idChucVu">
                                            <option value="0">___Chọn Chức Vụ___</option>
                                            @foreach ($chucvu as $item)
                                                <option value="{{ $item->idCV }}" @if($item->idCV == $nhanvien[0]->idChucVu) selected @endif>{{ $item->TenChucVu }}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Giới Tính</label>
                                    <div class="col-md-10">
                                        <div class="">
                                              
                                            @if ($nhanvien[0]->GioiTinh=='Nam')
                                            <label>
                                                <input type="radio" name="gioitinh" checked value="Nam">
                                                Nam
                                            </label>
                                            @else
                                            <label>
                                                <input type="radio" name="gioitinh"  value="Nam">
                                                Nam
                                            </label>
                                            @endif
                                            

                                            @if ($nhanvien[0]->GioiTinh=='Nu')
                                            <label>
                                                <input type="radio" name="gioitinh" checked value="Nu">
                                                Nữ
                                            </label>
                                            @else
                                            <label>
                                                <input type="radio" name="gioitinh"  value="Nu">
                                                Nữ
                                            </label>
                                            @endif
                                         
                                         
                                        </div>
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
                url: "{{ route('update_nhanvien') }}",
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