<!DOCTYPE html>
<html>
<head>
    <title>Hóa Đơn</title>
    <style>
        /* Định dạng CSS cho bảng */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        /* Các style khác */
    </style>
</head>
<body>
    <div id="thongtin">
        <h4>Ma Hoa Don :{{ $data[0]->MAHOADON }}</h4>
        <h4>Ngay Tao : {{ $data[0]->NGAYTAO }}</h4>
        <h4>Ma Nhan Vien : {{ $data[0]->MANHANVIEN }} </h4>
    </div>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Ma Ve</th>
                <th>Ma Ghe Ngoi</th>
                <th>Don Gia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $invoice)
            <tr>
                <td>{{ $invoice['idVe'] }}</td>
                <td>{{ $invoice['MaGheNgoi'] }}</td>
                <td>{{ $invoice['GiaVe'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Tong So Ve :{{ $data[0]->TONGSL }}</h3>
    <h3>Tong Thanh Tien: {{ $data[0]->TONGTIEN }}</h3>
</body>
</html>
