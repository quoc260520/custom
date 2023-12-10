<?php

namespace App\Http\Controllers\Ve;

use App\Http\Controllers\Controller;
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
    public function login(Request $request) {
        return view('Login');
    }
    public function Postlogin(Request $request) {
        $username = $request->username;
        $password = $request->password;

        // Tìm người dùng bằng tên đăng nhập
        $user = NguoiDung::where('TenDangNhap', $username)->first();
        if ($user!=null) {
            if (Hash::check($password,$user->MatKhau)) {
                if(NhanVien::where('idTK', $user->id)->first()) {
                    Auth::guard("web")->login($user);
                    return redirect('/');
                }
                Auth::guard("web")->login($user);
                return redirect('/trangchu');
            } else {
                return redirect('/trangchu');
            }
        }
    }
    public function index() {
        $phim = Phim::all()->toArray();
        $thucAn = ThucAn::all()->toArray();
        $khachHang = KhachHang::all()->toArray();
        return view('Login')->withPhim($phim)->withThucAn($thucAn)->withKhachHang($khachHang);
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
                                ->get();
        return $lichChieu;
    }
    public function layGhe(Request $request, $idLichChieu) {
        $lichChieu = LichChieu::find($idLichChieu);
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
            DB::beginTransaction();
                $hoaDon = HoaDon::create([
                    'MAKHACHHANG' => $request->mahk,
                    'MANHANVIEN'=>  $manv,
                    'TONGTIEN'=>  $request->tongtien,
                    'GHICHU'=>  $request->ghichu,
                    'TONGSL' =>  $request->ghichu,
                    'NGAYTAO' =>  now(),
                    'TinhTrang' =>  1,
                    'TRANGTHAI' =>  1,
                ]);
                $ve = Ve::create([
                    'idLichChieu' => $request->idLichChieu,
                    'MaGheNgoi' => $request->maGheNgoi,
                ]);
                $ctve = ChiTietVe::create([
                    'idVe' => $ve->idVe,
                    'MAHOADON' => $hoaDon->MAHOADON,
                    'GiaVe' => $giaVe,
                ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
