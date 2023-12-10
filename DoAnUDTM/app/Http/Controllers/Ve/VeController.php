<?php

namespace App\Http\Controllers\Ve;

use App\Http\Controllers\Controller;
use App\Models\ChiTietVe;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LichChieu;
use App\Models\Phim;
use App\Models\Ve;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function taoHoaDon( $maGheNgOi, $maLichChieu) {
        $makh=KhachHang::where('idTK',Auth::user()->id)->first();
        $maKhachHang=$makh->idKH;
        $maNhanVien=Auth::user()->id;
        $arrayMaGhe = explode(',', $maGheNgOi); // Chuyển chuỗi mã ghế ngồi thành mảng
        $createdVeIds = [];
        // Tạo vé dựa trên mã ghế ngồi và mã lịch chiếu
        foreach ($arrayMaGhe as $maGhe) {
            $ve=Ve::create([
                'idLichChieu' => $maLichChieu,
                'MaGheNgoi' => $maGhe,
            ]);
            $createdVeIds[] = $ve->idVe;
        }
    
        // Tính tổng số lượng vé và tổng tiền từ chi tiết vé
        $tongSoLuong = count($arrayMaGhe);
        $tongTien = 0;
       
        // Tạo hóa đơn
        $hoaDon = HoaDon::create([
            'TONGSL' => $tongSoLuong,
            'MAKHACHHANG' => $maKhachHang,
            
            // Ngày tạo hóa đơn, sử dụng Carbon để lấy ngày hiện tại
            // Các trường thông tin khác của hóa đơn
        ]);
    
        // Tạo chi tiết vé và tính tổng tiền
        foreach ($createdVeIds as $idVe) {
            $chiTietVe = ChiTietVe::create([
                'idVe' => $idVe,
                'MAHOADON' => $hoaDon->MAHOADON, // Mã hóa đơn được tạo trước đó
                // Các trường thông tin khác của chi tiết vé
            ]);
    
            // Tính tổng tiền từ giá vé của bảng Phim
            $idPhim = LichChieu::find($maLichChieu)->idPhim; // Lấy idPhim từ mã lịch chiếu
            $giaVe = Phim::find($idPhim)->DonGia; // Lấy giá vé từ bảng Phim
            $tongTien += $giaVe;
    
            // Cập nhật giá vé vào chi tiết vé
            $chiTietVe->update(['GiaVe' => $giaVe]);
        }
    
        // Cập nhật thông tin tổng số lượng và tổng tiền vào hóa đơn
        $hoaDon->update([
            'TONGTIEN' => $tongTien,
            'TinhTrang' => 0, // Giả sử TinhTrang là một trường để xác định hóa đơn đã thanh toán hay chưa
        ]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
