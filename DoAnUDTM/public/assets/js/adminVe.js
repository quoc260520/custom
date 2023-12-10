let lichChieuChon = [];
let danhSachDoAn = [];
let selectedSeats = [];
let tongHD = 0;
$(document).ready(function () {
    $('#create-ve-form').on('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        formData.append('maVe', JSON.stringify(selectedSeats));
        formData.append('tongTien', tongHD);
        $.ajax({
            url: `/admin/dat-ve/`,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
            data: formData,
            processData: false, // Ngăn xử lý dữ liệu gửi đi
            contentType: false, // Không thiết lập kiểu dữ liệu
            success: function (res) {
                alert(res.message);
                window.location.href = `/admin/dat-ve/hoa-don/${res.id}`;
            },
            error: function (er) {
                console.log(er);
                let err = er.responseJSON;
                $.each(err.errors, function (index, value) {
                    $('.errorMessage').append('<span class="text-danger">' +
                        value + '</span><br/>  ')
                });
            }
        });
    });

    $("#idPhim").on("change", function () {
        let idPhim = $(this).val()
        selectedSeats = [];
        $("#danhsachghe").empty();
        let lichChieu = $('#idLichChieu');
        lichChieu.html("");
        lichChieu.append(`<option value="">--Chọn Khung Giờ--</option>`);
        tinhTien();
        if (idPhim) {
            $.ajax({
                url: `/admin/dat-ve/lay-phong/${idPhim}`,
                type: 'GET',
                success: function (res) {
                    let phong = $('#idPhong');
                    phong.html("");
                    phong.append(`<option value="">--Chọn Phòng--</option>`);
                    res.forEach(function (item) {
                        phong.append(
                            `<option value="${item?.phong.idPhongChieu}">${item?.phong.TenPhong}</option>`
                        );
                    });
                },
                error: function (er) {
                    let err = er.responseJSON;
                    $.each(err.errors, function (index, value) {
                        $('.errorMessage').append('<span class="text-danger">' +
                            value + '</span><br/>  ')
                    });
                }
            });
        }
    });
    $("#idPhong, #ngayChieu").on("change", function () {
        let idPhim = $("#idPhim").val()
        let idPhong = $("#idPhong").val()
        let ngayChieu = $("#ngayChieu").val()
        selectedSeats = [];
        $("#danhsachghe").empty();
        $.ajax({
            url: `/admin/dat-ve/lay-lich?idPhong=${idPhong}&idPhim=${idPhim}&ngayChieu=${ngayChieu}`,
            type: 'GET',
            success: function (res) {
                let lichChieu = $('#idLichChieu');
                lichChieu.html("");
                lichChieu.append(`<option value="">--Chọn Khung Giờ--</option>`);
                res.forEach(function (item) {
                    lichChieu.append(
                        `<option value="${item?.idLichChieu}">${item?.ThoiGianChieu} -> ${item?.ThoiGianKetThuc}</option>`
                    );
                });
            },
            error: function (er) {
                let err = er.responseJSON;
                $.each(err.errors, function (index, value) {
                    $('.errorMessage').append('<span class="text-danger">' +
                        value + '</span><br/>  ')
                });
            }
        });
    });
    $("#idLichChieu").on("change", function () {
        let idLichChieu = $(this).val()
        selectedSeats = [];
        $("#danhsachghe").empty();
        initGhe(idLichChieu);
    });

    function initGhe(idLichChieu) {
        $.ajax({
            url: `/admin/dat-ve/lay-ghe/${idLichChieu}`,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                lichChieuChon = data
                var gheContainer = document.getElementById('danhsachghe');
                var m = data.lichChieu.phong.SoHangGhe; // Số hàng
                var n = data.lichChieu.phong.SoGheMotHang; // Số ghế mỗi hàng
                var arrayVeExits = data.ve.map(ve => ve.MaGheNgoi);
                var dem = 0;
                for (var i = 1; i <= m; i++) {
                    var hangGhe = document.createElement('li');
                    hangGhe.classList.add("hang-ghe", "d-flex", "flex-row");

                    for (var j = 1; j <= n; j++) {
                        var ghe = document.createElement('li');
                        var gheValue = "P" + data.lichChieu.idPhong + "LC" + data
                            .lichChieu.idLichChieu + "V" + dem;
                        ghe.innerHTML = gheValue;
                        ghe.value = gheValue; // Giá trị value

                        ghe.classList.add("ghe", "m-2", "btn", "btn-light");

                        // Kiểm tra xem phần tử có nằm trong mảng dsghedaco hay không
                        if (arrayVeExits.indexOf(gheValue) !== -1) {
                            ghe.classList.add('disabled');
                            ghe.disabled = true;
                        } else {
                            ghe.addEventListener('click', function () {
                                this.classList.toggle('btn-light');
                                var isSelected = this.classList.toggle('btn-primary');
                                if (isSelected) {
                                    selectedSeats.push(this.innerHTML);
                                } else {
                                    var index = selectedSeats.indexOf(this
                                        .innerHTML);
                                    if (index !== -1) {
                                        selectedSeats.splice(index, 1);
                                    }
                                }
                                $('#thongtinve').text("");
                                $('#thongtinve').text(selectedSeats);
                                tinhTien();
                            });
                        }
                        hangGhe.appendChild(ghe);
                        dem++;
                    }
                    gheContainer.appendChild(hangGhe);

                }
            }
        });
    }
});

function addThucAn() {
    let id = $("#thucAn").val()
    if (id) {
        if (danhSachDoAn.indexOf(id) === -1) {
            danhSachDoAn.push(id);
            data = doAn.find(function (item) {
                return item.MATHUCAN == id;
            });
            addInput(data)
        }
    }
}

function addInput(data) {
    const newRow = $('<tr>').append(
        $('<td>').append(
            $('<input>').attr({
                'type': 'hidden',
                'name': 'maDoAn[]',
                'value': data.MATHUCAN
            })
        ),
        $('<th>').text(data.TENTHUCAN),
        $('<td>').text(data.DONGIA),
        $('<td>').append(
            $('<input>').attr({
                'type': 'number',
                'min': 1,
                'name': `maDoAn_${data.MATHUCAN}`,
                'style': 'width:40px;',
                value: 1
            }).on('change', function () {
                tinhTien()
            })
        ),
        $('<td>').append(
            $('<button>').addClass('btn btn-danger').text('Xóa').on('click', function () {
                danhSachDoAn.splice(danhSachDoAn.indexOf(data.MATHUCAN), 1);
                removeTableRow($(this).closest('tr'));
            })
        )
    );
    $('#bodyTable').append(newRow);
    tinhTien()
}

function tinhTien() {
    let tong = 0
    if (selectedSeats.length > 0) {
        tong += selectedSeats.length * lichChieuChon.lichChieu.phim.DonGia
    }
    $('#bodyTable tr').each(function () {
        const row = $(this);
        if (row) {
            const maDoAn = row.find('input[name="maDoAn[]"]').val();
            const giaDoAn = row.find(`input[name="maDoAn_${maDoAn}"]`).val();
            const soLuong = row.find('td:eq(1)').text();
            tong += giaDoAn * soLuong
        }
    });
    tongHD = tong
    $("#tongTien").text(tong.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    }))
}
tinhTien()

function removeTableRow(row) {
    $(row).remove();
    tinhTien()
}
