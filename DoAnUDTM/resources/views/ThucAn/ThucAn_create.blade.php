@extends('Admin.Home.index')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <center><h4> Trang Thức Ăn</h4></center>
                  
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
                                
                                <input type="hidden" id="MATHUCAN" value="" name="MATHUCAN" placeholder="Mã Thức Ăn">
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Tên Thức Ăn</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="TENTHUCAN" value="" name="TENTHUCAN" placeholder="Tên Thức Ăn">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2" for="TenTheLoai">Đơn Giá</label>
                                    <div class="col-md-10">
                                        <div class="">
                                            <input class="form-control text-box single-line" type="text" id="DONGIA" value="" name="DONGIA" placeholder="Đơn Giá">
                                        </div>
                                    </div>
                                </div>
                            
                                <button type="submit">Thêm</button>
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
                url: "{{ route('create_thucan') }}",
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