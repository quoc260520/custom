@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Sửa Diễn Viên</h4></center>
                  
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
                                
                                <input type="hidden" id="MADV" value="{{ $dienvien[0]->MADV }}" name="MADV" placeholder="Mã Diễn Viên">
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Tên Diễn Viên</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="TENDV" value="{{ $dienvien[0]->TENDV }}" name="TENDV" placeholder="Tên Diễn Viên">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Mô Tả</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="MOTA" value="{{ $dienvien[0]->MOTA }}" name="MOTA" placeholder="Mô Tả">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenPhim">Tên Phim</label>
                                    <div class="col-md-10">
                                        <select id="mySelect" class="form-control" name="idPhim">
                                            @foreach ($phim as $item)
                                                <option value="{{ $item->idPhim }}" @if($item->idPhim == $dienvien[0]->idPhim) selected @endif>{{ $item->TenPhim }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit">Sửa</button>
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
                url: "{{ route('update_dienvien') }}",
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