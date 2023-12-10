@extends('Admin.Home.index')
@section('content')
    
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center><h4>Quản Lý Phim</h4></center>
                        
                    </div>
                </div>
               
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('get_create_phim') }}">Thêm Phim </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTables-phim" class="display" style="width: 1360px;color:black;">
                                    <thead>
                                        <tr>
                                            <th>Mã Phim</th>
                                            <th>Tên Phim</th>
                                            <th>Ảnh</th>
                                            <th>Mô tả</th>
                                            <th>Tên Thể Loại</th>
                                            <th>Thời Lượng</th>
                                            <th>Ngày Khởi Chiếu</th>
                                            <th>Năm Sản Xuất</th>
                                            <th>Đạo Diễn</th>
                                            <th>Hãng Sản Xuất</th>
                                            <th>Định Dạng</th>
                                            <th>#</th>
                                            <th>#</th>
    
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
@endsection