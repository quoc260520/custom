<?php

use App\Http\Controllers\ChucVu\ChucVuController;
use App\Http\Controllers\HoaDon\HoaDonController;
use App\Http\Controllers\LichChieu\LichChieuController;
use App\Http\Controllers\Phim\PhimController;
use App\Http\Controllers\PhongChieu\PhongChieuController;
use App\Http\Controllers\TaiKhoan\TaiKhoanController;
use App\Http\Controllers\Ve\AdminVeController;
use App\Http\Controllers\Ve\VeController;
use App\Models\Phim;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('Phim.Home_Phim');
})->name('home_phim');
Route::get('/chucvu', function () {
    return view('ChucVu.Home_ChucVu');
})->name('home_chucvu');
Route::get('/theloai', function () {
    return view('TheLoai.Home_TheLoai');
})->name('home_theloai');
Route::get('/manhinh', function () {
    return view('LoaiManHinh.Home_LoaiManHinh');
})->name('home_manhinh');
Route::get('/thucan', function () {
    return view('ThucAn.Home_ThucAn');
})->name('home_thucan');
Route::get('/dienvien', function () {
    return view('DienVien.Home_DienVien');
})->name('home_dienvien');
Route::get('/khachhang', function () {
    return view('KhachHang.Home_KhachHang');
})->name('home_khachhang');
Route::get('/phongchieu', function () {
    return view('PhongChieu.Home_PhongChieu');
})->name('home_phongchieu');
Route::get('/phim/phimdangchieu',[PhimController::class,'phimdangchieu'])->name('phimdangchieu');
Route::get('/phim/phimsapchieu',[PhimController::class,'phimsapchieu'])->name('phimsapchieu');
Route::get('/phim/theloai/{id}',[PhimController::class,'phimtheoloai'])->name('phimtheotheloai');
Route::get('/phim/search', [PhimController::class, 'search'])->name('timkiemphim');
Route::get('/phim/thongtindatve/{id}',[PhimController::class,'thongtindatve'])->name('datve');
Route::get('/phim/lichchieu/{idphim}/{ngay}',[PhimController::class,'laycacxuatchieu']);
Route::get('/phim/danhsachghe/{idphong}/{idlichchieu}',[PhongChieuController::class,'danhsachghe']);
Route::get('/phim/taohoadon/{maGheNgOi}/{maLichChieu}',[VeController::class,'taoHoaDon']);
//////////////////////////
// Route::get('/phongchieu', function () {
//     return view('PhongChieu.Home_PhongChieu');
// });
// Route::get('/thucan', function () {
//     return view('ThucAn.Home_ThucAn');
// });
// Route::get('/lichchieu', function () {
//     return view('LichChieu.Home_LichChieu');
// });
// Route::get('/theloai', function () {
//     return view('TheLoai.Home_TheLoai');
// });
// Route::get('/khachhang', function () {
//     return view('KhachHang.Home_KhachHang');
// });
Route::get('/trangchu',[PhimController::class,'trangchu']);
Route::get('/trang-chu/detail-phim/{id}',[PhimController::class,'show'])->name('detailphim');
Route::post('/login-tai-khoan',[TaiKhoanController::class,'index'])->name('login');
Route::get('/logout-tai-khoan',[TaiKhoanController::class,'dangxuat'])->name('dangxuat');
Route::get('/Error-Page',function(){
    return view('ErrorPage.Error');
})->name('errorpage');



Route::get('/admin/phim', function () {
    return view('Admin.Home.h');
});

Route::get('/theloai-phim/{id}',[PhimController::class,'phimtheotheloai']);
Route::get('/login',[AdminVeController::class,'login'])->name('login');
Route::post('/login',[AdminVeController::class,'postLogin'])->name('post.login');
Route::prefix('admin/dat-ve')->middleware('auth')->group(function () {
    Route::get('/',[AdminVeController::class,'index'])->name('admin.dat-ve');
    Route::get('lay-phong/{idPhim}',[AdminVeController::class,'layPhong'])->name('admin.lay-phong');
    Route::get('lay-lich',[AdminVeController::class,'layLich'])->name('admin.lay-phim');
    Route::get('lay-ghe',[AdminVeController::class,'layGhe'])->name('admin.lay-ghe');
    Route::post('dat-ve',[AdminVeController::class,'datVe'])->name('admin.post.dat-ve');
});
