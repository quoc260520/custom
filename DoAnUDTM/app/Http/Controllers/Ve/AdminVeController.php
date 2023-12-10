<?php

namespace App\Http\Controllers\Ve;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                return redirect('/fhsjhkhd');
            }
        }
    }
    public function index() {
        dd(Auth::user());
    }
    public function layPhong(Request $request, $idPhim) {

    }
    public function layLich() {

    }
    public function layGhe() {

    }
    public function datVe() {

    }
}
