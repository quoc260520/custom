<?php

namespace App\Http\Controllers\Ve;

use App\Http\Controllers\Controller;
use App\Models\ChiTietThucAn;
use App\Models\ChiTietVe;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LichChieu;
use App\Models\NguoiDung;
use App\Models\NhanVien;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\ThucAn;
use App\Models\Ve;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminVeController extends Controller
{
    public function index() {
        $phim = Phim::all();
        $thucAn = ThucAn::all();
        $khachHang = KhachHang::all();
        return view('Admin.Ve.index')->withPhim($phim)->withThucAn($thucAn)->withKhachHang($khachHang);
    }
    public function layPhong(Request $request, $idPhim) {
        $phong = LichChieu::where('idPhim',$idPhim)->with('phong')->get();
        return $phong;
    }
    public function layLich(Request $request) {
        $idPhim = $request->idPhim;
        $idPhong = $request->idPhong;
        $ngayChieu = $request->ngayChieu;
        $lichChieu = LichChieu::where('idPhim',$idPhim)->where('idPhong',$idPhong)
                                ->whereDate('ThoiGianChieu',Carbon::parse($ngayChieu))
                                ->orderBy('ThoiGianChieu','ASC')
                                ->selectRaw('TIME(ThoiGianChieu) as ThoiGianChieu, TIME(ThoiGianKetThuc) as ThoiGianKetThuc, idPhong,idLichChieu, idPhim')
                                ->get();
        return $lichChieu;
    }
    public function layGhe(Request $request, $idLichChieu) {
        $lichChieu = LichChieu::with('phong','phim')->find($idLichChieu);
        $ve = Ve::where('idLichChieu', $idLichChieu)->get();
        return [
            'lichChieu' => $lichChieu,
            've' => $ve
        ];
    }
    public function datVe(Request $request) {
        try {
            $manv = NhanVien::where('idTK', Auth::user()->id)->first()->idNhanVien;
            $lichChieu = LichChieu::with('phim')->find($request->idLichChieu);
            $giaVe = $lichChieu->phim->DonGia;
            $tongHD = 0;
            $tongSL = 0;
            DB::beginTransaction();
                $hoaDon = HoaDon::create([
                    'MAKHACHHANG' => null,
                    'MANHANVIEN'=>  $manv,
                    'TONGTIEN'=>  $request->tongTien,
                    'GHICHU'=>  "",
                    'TONGSL' =>  0,
                    'NGAYTAO' =>  now(),
                    'TinhTrang' =>  1,
                    'TRANGTHAI' =>  1,
                ]);
                foreach(json_decode($request->maVe) as $maVe) {
                    $check = Ve::where('idLichChieu', $request->idLichChieu)->where('MaGheNgoi', $maVe)->count();
                    if($check > 0) {
                        DB::rollBack();
                        return response()->json([
                            'errors' => ['Vé phim đã được đặt',]
                        ],500);
                    }
                    $ve = Ve::create([
                        'idLichChieu' => $request->idLichChieu,
                        'MaGheNgoi' => $maVe,
                    ]);
                    $ctve = ChiTietVe::create([
                        'idVe' => $ve->idVe,
                        'MAHOADON' => $hoaDon->MAHOADON,
                        'GiaVe' => $giaVe,
                    ]);
                    $tongHD  += (int)$giaVe;
                    $tongSL += 1;
                }
                foreach ($request->maDoAn ?? [] as $ma){
                    $thucAn = ThucAn::find($ma);
                    $sl = (int)$request->maDoAn_.$ma;
                    ChiTietThucAn::create([
                        'MATHUCAN' => $ma,
                        'MAHOADON' => $hoaDon->MAHOADON,
                        'SOLUONG' => $sl
                    ]);
                    $tongHD  += $sl * (int)$thucAn->DONGIA;
                    $tongSL += $sl;
                }
                $hoaDon->update([
                    'TONGTIEN'=>  $tongHD,
                    'TONGSL' =>  $tongSL,
                ]);
            DB::commit();
            return response()->json([
                'message' => "Tạo hóa đơn thành công",
                'id' => $hoaDon->MAHOADON

            ],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => ['Đã có lỗi xảy ra',]
            ],500);
        }
    }
    public function layHoaDon($idHoaDon) {
        $hoaDon = HoaDon::where('MAHOADON', $idHoaDon)
        ->with('chiTietVe.ve.lichChieu.phong', 'chiTietVe.ve.lichChieu.phim', 'chiTietThucAn.thucAn', 'nhanVien')
        ->first();
        return view('Admin.Ve.HoaDon')->withHoaDon($hoaDon);
    }
}
