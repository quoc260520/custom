@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Sửa Phim</h4></center>
                  
                </div>
            </div>
            
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                   
                    <div class="card-body">
                        <div class="form-validation">
                            
                            <form id="update-phim-form" method="POST" action="" enctype="multipart/form-data">
                                @csrf
                               
                                            <input type="hidden" id="idPhim" value="{{ $phim[0]->idPhim}}" name="idPhim" placeholder="Mã Phim">
                                   
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Tên Phim</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input type="text" class="form-control text-box single-line" id="TenPhim" value="{{ $phim[0]->TenPhim }}" name="TenPhim" placeholder="Tên Phim">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Mô Tả</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input type="text" class="form-control text-box single-line" id="MoTa" value="{{ $phim[0]->MoTa}}" name="MoTa" placeholder="Mô Tả">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Thời Lượng</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input type="text" class="form-control text-box single-line" id="ThoiLuong" value="{{ $phim[0]->ThoiLuong }}" name="ThoiLuong" placeholder="Thời Lượng">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Hãng Sản Xuất</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input type="text" class="form-control text-box single-line" id="HangSanXuat" value="{{ $phim[0]->HangSanXuat }}" name="HangSanXuat" placeholder="Hãng Sản Xuất">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" class="form-control text-box single-line" for="TenPhim">Đạo Diễn</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input type="text" class="form-control text-box single-line" id="DaoDien" value="{{ $phim[0]->DaoDien }}" name="DaoDien" placeholder="Đạo diễn">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2"  for="TenPhim">Năm Sản Xuất</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input type="text" class="form-control text-box single-line" id="NamSX" value="{{ $phim[0]->NamSX }}" name="NamSX" placeholder="Năm sản xuất">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <select id="mySelect" class="form-control" name="idTheLoai">
                                            @foreach ($loaiphim as $item)
                                                <option value="{{ $item->idTheLoai }}" @if($item->idTheLoai == $phim[0]->idTheLoai) selected @endif>{{ $item->TenTheLoai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <select id="mySelect" class="form-control" name="idMH">
                                            @foreach ($dinhdang as $item)
                                                <option value="{{ $item->idMH }}" @if($item->idMH == $phim[0]->idMH) selected @endif>{{ $item->TenMH }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Ngày Khởi chiếu</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input type="date" class="form-control text-box single-line" id="NgayKhoiChieu" value="{{ $phim[0]->NgayKhoiChieu }}" name="NgayKhoiChieu" placeholder="Ngày Khởi Chiếu">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Áp Phích</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <img src="{{ asset('assets/Image/' . $phim[0]->ApPhich) }}" alt="ảnh phim" id="ApPhich">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Đổi Áp Phích</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="file"  name="anh" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Đơn Giá</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="number" id="DonGia" value="{{ $phim[0]->DonGia }}" name="DonGia" placeholder="Nhập Giá">
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit">Cập Nhật</button>
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
        $('#update-phim-form').on('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('update_phim') }}",
                type: 'POST',
                data: formData,
                processData: false, // Ngăn xử lý dữ liệu gửi đi
                contentType: false, // Không thiết lập kiểu dữ liệu
                success: function(res) {
                    console.log(res);
                    alert(res.message);
                    window.location.href = document.referrer;
                }
            });
        });
    });
</script>
@endsection