@extends('Admin.Home.index')
@section('content')
    
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center><h4>Quản Lý Lịch Chiếu</h4></center>
                        
                    </div>
                </div>
               
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('get_create_lichchieu') }}">Thêm Lịch Chiếu </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTables-lichchieu" class="display" style="width: 1360px;color:black;">
                                    <thead>
                                        <tr>
                                            <th>Mã Lịch Chiếu</th>
                                            <th>Thời Gian Chiếu</th>
                                            <th>Thời Gian Kết Thúc</th>
                                            <th>Tên Phòng Chiếu</th>    
                                            <th>Tên Phim</th>                              
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