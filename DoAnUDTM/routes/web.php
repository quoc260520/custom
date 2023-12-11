<?php

use App\Http\Controllers\ChucVu\ChucVuController;
use App\Http\Controllers\HoaDon\HoaDonController;
use App\Http\Controllers\KhachHang\KhachHangController;
use App\Http\Controllers\LichChieu\LichChieuController;
use App\Http\Controllers\PDF\PDFController;
use App\Http\Controllers\Phim\PhimController;
use App\Http\Controllers\PhongChieu\PhongChieuController;
use App\Http\Controllers\TaiKhoan\TaiKhoanController;
use App\Http\Controllers\ThongKe\ThongKeController;
use App\Http\Controllers\Ve\VeController;
use App\Models\Phim;
use Barryvdh\DomPDF\PDF;
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
Route::middleware('admin')->group(function(){
Route::get('/phim', function () {
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
Route::get('/nhanvien', function () {
    return view('NhanVien.Home_NhanVien');
})->name('home_phongchieu');
Route::get('/hoadon', function () {
    return view('HoaDon.Home_HoaDon');
});
Route::get('/thongke',[ThongKeController::class,'index']);
Route::get('/lichchieu', function () {
    return view('LichChieu.Home_LichChieu');
});
});
Route::get('/phim/phimdangchieu',[PhimController::class,'phimdangchieu'])->name('phimdangchieu');
Route::get('/phim/phimsapchieu',[PhimController::class,'phimsapchieu'])->name('phimsapchieu');
Route::get('/phim/theloai/{id}',[PhimController::class,'phimtheoloai'])->name('phimtheotheloai');
Route::get('/phim/search', [PhimController::class, 'search'])->name('timkiemphim');
Route::get('/phim/thongtindatve/{id}',[PhimController::class,'thongtindatve'])->name('datve');
Route::get('/phim/lichchieu/{idphim}/{ngay}',[PhimController::class,'laycacxuatchieu']);
Route::get('/phim/danhsachghe/{idphong}/{idlichchieu}',[PhongChieuController::class,'danhsachghe']);
Route::get('/phim/taohoadon/{maGheNgOi}/{maLichChieu}/new-page',[VeController::class,'taoHoaDon']);
Route::get('/chitietdatve/{id}',[VeController::class,'chitietdatve'])->name('chitietdatve');
Route::get('/thongtincanhan', [KhachHangController::class,'getthongtincanhan']);
Route::post('/capnhatthongtincanhan', [KhachHangController::class,'capnhathongtin'])->name('capnhatthongtin');
Route::get('/doimatkhau', [KhachHangController::class,'getdoimatkhau']);
Route::post('/capnhatmatkhaumoi', [KhachHangController::class,'updatematkhau'])->name('doimatkhau');
//////////////////////////

Route::get('/',[PhimController::class,'trangchu']);
Route::get('/trang-chu/detail-phim/{id}',[PhimController::class,'show'])->name('detailphim');




Route::get('/admin/phim', function () {
    return view('Admin.Home.h');
});
Route::get('/banve', function () {
    return view('BanVeTaiQuay.BanVe');
});
Route::get('/theloai-phim/{id}',[PhimController::class,'phimtheotheloai']);

Route::get('/export-pdf/{id}',[PDFController::class,'exportPDF']);
Route::get('/thongtinxuatpdf/{id}',[HoaDonController::class,'thongtinxuatpdf']);
Route::get('/thanhtoan/{id}',[VeController::class,'thanhtoan']);

Route::controller(VeController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::get('handle-payment/{idHD}', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment/{id}', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success/{id}', 'paymentSuccess')->name('success.payment');
    });


Route::post('/login-tai-khoan',[TaiKhoanController::class,'index'])->name('login');
Route::get('/logout-tai-khoan',[TaiKhoanController::class,'dangxuat'])->name('dangxuat');

Route::post('/create-tai-khoan',[TaiKhoanController::class,'create'])->name('sigin');

Route::get('/Error-Page',function(){
    return view('ErrorPage.Error');
})->name('errorpage');

Route::get('/new-page', [VeController::class,'test']);
Route::get('/lichsumuahang', [HoaDonController::class,'getlichsumua']);
