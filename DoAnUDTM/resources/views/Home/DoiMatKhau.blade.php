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
                    <h1> Đổi Mật Khẩu</h1>
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
                    <form action="{{ route('doimatkhau') }}" method="POST">
                        @csrf
                        <div class="row">
                        
                            <div class="col-md-12 form-it" >
                                
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Mật Khẩu Hiện Tại</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="text" id="matkhauhientai" value="" name="matkhauhientai" placeholder="Nhập Mật Khẩu Hiện Tại">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Mật Khẩu Mới</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="text" id="matkhaumoi" value="" name="matkhaumoi" placeholder="Nhập Mật Khẩu Mới">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="min-height: 40px">
    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4" for="TenPhim">Nhập Lại Mật Khẩu Mới</label>
                
                                    <div class="col-md-8">
                                        <div class="">
                                            <input class=" " type="text" id="rqmatkhaumoi" value="" name="rqmatkhaumoi" placeholder="Nhập Lại Mật Khẩu Mới">
                                        </div>
                                    </div>
                                </div>
                                <br>
                               
                                <br>
                                <hr style="border: 1px solid black;">
                                
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                              
                                <input class="submit" type="submit" value="Lưu Thay Đổi">
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


