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
                    <h1>Lịch Sử Mua Hàng</h1>
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
              
                    

                    <div class="row">
                        
                        <div class="col-md-12 form-it" >
                            <div class="col-md-3" style="background-color: aqua; min-height: 250px;padding: 5px">
                                <h3>Mã Hóa Đơn</h3>
                            </div>
                           
                           
                       
                        </div>
                    </div>
                    
        
               

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


