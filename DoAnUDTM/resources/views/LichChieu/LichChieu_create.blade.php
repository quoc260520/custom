
@extends('TrangChu')
@section('css')

<style>
    .table th{ 
        font-size: 13px;
    }
    .table tbody{
        background-color: lightgrey;
        
    }
    a.chon.chosen {
    opacity: 0.5; /* Đặt độ mờ của nội dung đã chọn */
}

</style>
@endsection
@section('content')
<h2>Thêm</h2>
<div class="errorMessage">

</div>
    <form id="create-phim-form" method="POST" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="idLichChieu" value="" name="idLichChieu" placeholder="Mã Lịch Chiếu">
        <input type="datetime-local" id="ThoiGianChieu" name="ThoiGianChieu" step="any">


    
        <select id="idPhim" name="idPhim">
            @foreach ($phim as $item)
                <option value="{{ $item->idPhim, }}">{{ $item->TenPhim }}</option>
            @endforeach
        </select>
        <input type="number" id="GiaVe" value="" name="GiaVe" placeholder="Giá Vé">
        
        <button class="add"  type="submit">Thêm</button>
       <div class="container">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Mã Món</th>
                <th scope="col">Tên Món</th>
                <th scope="col">Chọn</th>
              </tr>
            </thead>
            <tbody id="phim-list">
            </tbody>
          </table>
       </div>
    </form>
@endsection
@section('js')
<script>
   $(document).ready(function() {
    let idphong; // Biến để lưu trữ id phòng đã chọn

    // Lắng nghe sự kiện khi click vào một thời gian chiếu khác
    document.getElementById('ThoiGianChieu').addEventListener('change', function() {
        let thoiGianChieuValue = this.value;
        let selectedPhimId = document.getElementById('idPhim').value;

        // Sử dụng AJAX để lấy danh sách phòng chiếu theo thời gian và phim đã chọn
        $.ajax({
            url: '/api/getdanhsachphongtheokhoangtrong/' + thoiGianChieuValue + '/' + selectedPhimId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let danhmucs = data.phongchieu;
                let danhmucList = $('#phim-list');
                danhmucList.empty();
                danhmucs.forEach(function(phim) {
                    danhmucList.append(`<tr>
                        <th scope="row">${phim.idPhongChieu}</th>
                        <td>${phim.TenPhong}</td>
                        <td><a href="" data-id="${phim.idPhongChieu}" data-toggle="modal" data-target="#updateModal"  data-ten="${phim.TenPhong}" class="chon"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        </tr>`);
                });
            }
        });
    });

    // Lắng nghe sự kiện khi chọn một phim khác
    document.getElementById('idPhim').addEventListener('change', function() {
        let selectedPhimId = this.value;
        let thoiGianChieuValue = document.getElementById('ThoiGianChieu').value;

        // Sử dụng AJAX để lấy danh sách phòng chiếu theo thời gian và phim đã chọn
        $.ajax({
            url: '/api/getdanhsachphongtheokhoangtrong/' + thoiGianChieuValue + '/' + selectedPhimId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let danhmucs = data.phongchieu;
                let danhmucList = $('#phim-list');
                danhmucList.empty();
                danhmucs.forEach(function(phim) {
                    danhmucList.append(`<tr>
                        <th scope="row">${phim.idPhongChieu}</th>
                        <td>${phim.TenPhong}</td>
                        <td><a href="" data-id="${phim.idPhongChieu}" data-toggle="modal" data-target="#updateModal"  data-ten="${phim.TenPhong}" class="chon"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        </tr>`);
                });
            }
        });
    });

    // Lắng nghe sự kiện khi click vào một phòng chiếu
    $(document).on('click', 'a.chon', function(e) {
        e.preventDefault();
        $('a.chon').removeClass('chosen');
        $(this).addClass('chosen');
        idphong = $(this).attr('data-id');
    });

    // Lắng nghe sự kiện khi click vào nút "Thêm"
    $(document).on('click', '.add', function(event) {
        event.preventDefault();
        let thoiGianChieuValue = document.getElementById('ThoiGianChieu').value;
        let selectedPhimId = document.getElementById('idPhim').value;
        let GiaVe = document.getElementById('GiaVe').value;

        // Sử dụng AJAX để gửi dữ liệu đến controller để tạo lịch chiếu mới
        $.ajax({
            url: "{{ route('create_lichchieu') }}",
            method: 'POST',
            data: {
                thoiGianChieuValue: thoiGianChieuValue,
                selectedPhimId: selectedPhimId,
                idphong: idphong,
                GiaVe: GiaVe
            },
            success: function(res) {
                alert(res.message);
            }
        });
    });
});

</script>

@endsection