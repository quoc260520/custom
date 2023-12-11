@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Bán Vé</h4></center>
                  
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="form-group col-3">
                <label class="col-md-5" for="TenPhim">Chọn Thể Loại</label>
                <div class="col-md-7">
                    <select class="form-control" id="idPhim" name="idPhim">
                        <option value="0">____Chọn Thể Loại____</option>
                       
                    </select>
                
                </div>
            </div>
            <div class="form-group col-3">
                <label class="col-md-5" for="TenPhim">Chọn Phim</label>
                <div class="col-md-7">
                    <select class="form-control" id="idNhanVien" name="idNhanVien">
                        <option value="0">___Chọn Phim___</option>
                      
                  
                    </select>
                
                </div>
            </div>
            <div class="form-group col-3">
                <label class="col-md-5" for="TenPhim">Chọn Ngày Chiếu</label>
                <div class="col-md-7">
                    <select class="form-control" id="idNhanVien" name="idNhanVien">
                        <option value="0">___Chọn Ngày___</option>
                      
                  
                    </select>
                
                </div>
            </div>
            <div class="form-group col-3">
                <label class="col-md-5" for="TenPhim">Chọn Giờ</label>
                <div class="col-md-7">
                    <select class="form-control" id="idNhanVien" name="idNhanVien">
                        <option value="0">___Chọn Giờ___</option>
                      
                  
                    </select>
                
                </div>
            </div>
       </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                   
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3" style="background-color: darkgray">
                                phần hình ảnh thức ăn
                            </div> 
                            <div class="col-md-6" style="background-color: antiquewhite">
                                phần ghế ngồi
                            </div>
                            <div class="col-md-3" style="background-color: bisque">
                                thông tin vé 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection