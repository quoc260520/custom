@extends('Admin.Home.index')
@section('content')
    
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center><h4>Quản Lý Phòng</h4></center>
                        
                    </div>
                </div>
               
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('get_create_phongchieu') }}">Thêm Phòng Mới </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTables-phong" class="display" style="width: 1360px;color:black;">
                                    <thead>
                                        <tr>
                                            <th>Mã Phòng</th>
                                            <th>Tên Phòng</th>
                                            <th>Màn Hình</th>
                                            <th>Chỗ Ngồi</th>    
                                            <th>Số Hàng Ghế</th>     
                                            <th>Số Ghế 1 Hàng</th>
                                            <th>Trạng Thái</th>                                
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