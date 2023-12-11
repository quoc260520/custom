@extends('Home.Main')
@section('content')
<style>
    td,th{
        color: aliceblue;
    }
</style>
<div class="hero user-hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hero-ct">
                    <h1> Thông Tin Cá Nhân</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-single">

<div class="container">
    <div class="row ipad-width">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-style-1 user-pro" action="#">
                    <form action="{{ route('capnhatthongtin') }}" method="POST" >
                        @csrf
                        <div class="row">
                        
                            <div class="col-md-12 form-it" >
                                <label for="">Tên Đăng Nhập :   {{ Auth::user()->TenDangNhap }}</label><br>
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Họ Và Tên</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="text" id="hoten" value="{{ $thongtin->HoTen }}" name="hoten" placeholder="Nhập Họ Và Tên">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Email</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="text" id="email" value="{{ $thongtin->Email }}" name="email" placeholder="Nhập Email">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Ngày Sinh</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="date" id="ngaysinh" value="{{ $thongtin->NgaySinh }}" name="ngaysinh" placeholder="Nhập Ngày Sinh">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Số Điện Thoại</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="text" id="sdt" value="{{ $thongtin->SDT }}" name="sdt" placeholder="Số Điện Thoại">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Địa Chỉ</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="text" id="diachi" value="{{ $thongtin->DiaChi }}" name="diachi" placeholder="Nhập Địa Chỉ">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr style="border: 1px solid black;">
                                
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                              
                                <input class="submit" type="submit" value="Cập Nhật">
                            </div>
                            <div class="col-md-2">
                                <a href="">Đổi Mật Khẩu</a>
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
     let mahoadon=document.getElementById('mahoadon').value;
     $('.datve').on('click', function(event) {
        event.preventDefault();
        $.ajax({
             url: '/thanhtoan/'+mahoadon,
             type: 'GET',
             dataType: 'json',
             success: function(data) {
                 alert(data.msg);
                 window.location.href = '/';
             }
         });
    });
    
 });
 
 </script>

@endsection


