@extends('Admin.Home.index')
@section('content')
    
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center><h4>Quản Lý Hóa Đơn</h4></center>
                    </div>
                </div>
               
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTables-hoadon" class="display" style="width: 1360px;color:black;">
                                    <thead>
                                        <tr>
                                            <th>Tên Khách Hàng</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Ngày Mua</th>
                                            <th>Tổng Vé</th>
                                            <th>Tổng Tiền</th>    
                                            <th>Tình Trạng</th>     
                                            <th>Trạng Thái</th>    
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