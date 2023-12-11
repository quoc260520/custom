<?php

use App\Http\Controllers\ChucVu\ChucVuController;
use App\Http\Controllers\DienVien\DienVienController;
use App\Http\Controllers\HoaDon\HoaDonController;
use App\Http\Controllers\KhachHang\KhachHangController;
use App\Http\Controllers\LichChieu\LichChieuController;
use App\Http\Controllers\LoaiManHinh\LoaiManHinhController;
use App\Http\Controllers\NhanVien\NhanVienController;
use App\Http\Controllers\Phim\PhimController;
use App\Http\Controllers\PhongChieu\PhongChieuController;
use App\Http\Controllers\TaiKhoan\TaiKhoanController;
use App\Http\Controllers\TheLoai\TheLoaiController;
use App\Http\Controllers\ThongKe\ThongKeController;
use App\Http\Controllers\ThucAn\ThucAnController;
use App\Http\Controllers\Ve\VeController;
use App\Models\LichChieu;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// các route của phim



/// các route của trang chủ

Route::get('/theloai-phim-theo-the-loai',[TheLoaiController::class,'trangchu'])->name('theloaitrangchu');

// các route của tài khoản


// các route của chức vụ



// các route của loại màn hình




// các route của dien vien
Route::middleware('admin')->group(function(){
    Route::get('/',[PhimController::class,'index'])->name('index');
    Route::get('/admin/create/phim',[PhimController::class,'getcreate'])->name('get_create_phim');
    Route::post('/create_phim', [PhimController::class, 'create'])->name('create_phim');
    Route::get('/delete_phim/{id}',[PhimController::class,'delete'])->name('delete_phim');
    Route::get('/get_update_phim/{id}',[PhimController::class,'get_update'])->name('get_update_phim');
    Route::post('/update_phim',[PhimController::class,'update'])->name('update_phim');
    ////////
    Route::get('/chucvu',[ChucVuController::class,'index']);
    Route::get('/admin/create/chucvu',[ChucVuController::class,'get_create'])->name('get_create_chucvu');
    Route::get('/delete_chucvu/{id}',[ChucVuController::class,'delete'])->name('delete_chucvu');
    Route::post('/create_chucvu',[ChucVuController::class,'create'])->name('create_chucvu');
    Route::get('/get_update_chucvu/{id}',[ChucVuController::class,'get_update'])->name('get_update_chucvu');
    Route::post('/update_chucvu',[ChucVuController ::class,'update'])->name('update_chucvu');
    ///////
    Route::get('/theloai',[TheLoaiController::class,'index']);
    Route::get('/delete_theloai/{id}',[TheLoaiController::class,'delete'])->name('delete_theloai');
    Route::post('/create_theloai',[TheLoaiController::class,'create'])->name('create_theloai');
    Route::post('/update_theloai',[TheLoaiController ::class,'update'])->name('update_theloai');
    Route::get('/admin/create/theloai',[TheLoaiController::class,'get_create'])->name('get_create_theloai');
    Route::get('/get_update_theloai/{id}',[TheLoaiController::class,'get_update'])->name('get_update_theloai');
    /////
    
    Route::get('/manhinh',[LoaiManHinhController::class,'index']);
    Route::get('/delete_loaimanhinh/{id}',[LoaiManHinhController::class,'delete'])->name('delete_manhinh');
    Route::post('/create_loaimanhinh',[LoaiManHinhController::class,'create'])->name('create_manhinh');
    Route::post('/update_loaimanhinh',[LoaiManHinhController ::class,'update'])->name('update_manhinh');
    Route::get('/admin/create/manhinh',[LoaiManHinhController::class,'get_create'])->name('get_create_manhinh');
    Route::get('/get_update_manhinh/{id}',[LoaiManHinhController::class,'get_update'])->name('get_update_manhinh');
    //////
    Route::get('/thucan',[ThucAnController::class,'index']);
    Route::get('/delete_thucan/{id}',[ThucAnController::class,'delete'])->name('delete_thucan');
    Route::get('/get_create_thucan',[ThucAnController::class,'get_create'])->name('get_create_thucan');
    Route::post('/create_thucan',[ThucAnController::class,'create'])->name('create_thucan');
    Route::get('/get_update_thucan/{id}',[ThucAnController::class,'get_update'])->name('get_update_thucan');
    Route::post('/update_thucan',[ThucAnController ::class,'update'])->name('update_thucan');
    
    /////////
    
    
    
    Route::get('/dienvien',[DienVienController::class,'index']);
    Route::get('/delete_dienvien/{id}',[DienVienController::class,'delete'])->name('delete_dienvien');
    Route::post('/create_dienvien',[DienVienController::class,'create'])->name('create_dienvien');
    Route::post('/update_dienvien',[DienVienController ::class,'update'])->name('update_dienvien');
    Route::get('/admin/create/dienvien',[DienVienController::class,'get_create'])->name('get_create_dienvien');
    Route::get('/get_update_dienvien/{id}',[DienVienController::class,'get_update'])->name('get_update_dienvien');
    //////
    
    
    
    Route::get('/khachhang',[KhachHangController::class,'index']);
    Route::get('/delete_khachhang/{id}',[KhachHangController::class,'delete'])->name('delete_khachhang');
    Route::post('/create_khachhang',[KhachHangController::class,'create'])->name('create_khachhang');
    Route::post('/update_khachhang',[KhachHangController ::class,'update'])->name('update_khachhang');
    Route::get('/admin/create/khachhang',[KhachHangController::class,'get_create'])->name('get_create_khachhang');
    Route::get('/get_update_khachhang/{id}',[KhachHangController::class,'get_update'])->name('get_update_khachhang');
    
    ////////
    
    Route::get('/phongchieu',[PhongChieuController::class,'index']);
    Route::get('/delete_phongchieu/{id}',[PhongChieuController::class,'delete'])->name('delete_phongchieu');
    Route::get('/get_create_phongchieu',[PhongChieuController::class,'get_create'])->name('get_create_phongchieu');
    Route::post('/create_phongchieu',[PhongChieuController::class,'create'])->name('create_phongchieu');
    Route::get('/get_update_phongchieu/{id}',[PhongChieuController::class,'get_update'])->name('get_update_phongchieu');
    Route::post('/update_phongchieu',[PhongChieuController ::class,'update'])->name('update_phongchieu');
    //////////////////
    Route::get('/nhanvien',[NhanVienController::class,'index']);
    Route::get('/admin/create/nhanvien',[NhanVienController::class,'get_create'])->name('get_create_nhanvien');
    Route::post('/create_nhanvien',[NhanVienController::class,'create'])->name('create_nhanvien');
    Route::get('/delete_nhanvien/{id}',[NhanVienController::class,'delete'])->name('delete_nhanvien');
    Route::get('/get_update_nhanvien/{id}',[NhanVienController::class,'get_update'])->name('get_update_nhanvien');
    Route::post('/update_nhanvien',[NhanVienController ::class,'update'])->name('update_nhanvien');
    //////
    
    Route::get('/hoadon',[HoaDonController::class,'index']);
    Route::get('/nhanve/{id}',[HoaDonController::class,'nhanve']);
    
    ///////
    // các route của phòng chiếu
    
    // các route của thức ăn
    
    
    
    
    // các route của lịch chiếu
    
    Route::get('/lichchieu',[LichChieuController::class,'index']);
    Route::get('/delete_lichchieu/{id}',[LichChieuController::class,'delete'])->name('delete_lichchieu');
    Route::get('/get_update_lichchieu/{id}',[LichChieuController::class,'get_update'])->name('get_update_lichchieu');
    Route::post('/update_lichchieu',[LichChieuController ::class,'update'])->name('update_lichchieu');
    Route::get('/get_create_lichchieu',[LichChieuController::class,'get_create'])->name('get_create_lichchieu');
    Route::post('/create_lichchieu',[LichChieuController::class,'tao'])->name('create_lichchieu');
    Route::get('/getdanhsachphongtheokhoangtrong/{thoigianchieu}/{idphim}',[LichChieuController::class,'danhSachPhongChieuTrongKhoangThoiGian'])->name('danhsachphongchieu');
    
    // các route của thon ke
    Route::get('/phim/layhoadontheophim/{idphim}',[ThongKeController::class,'layhoadontheophim']);
    
    Route::get('/phim/layhoadontheonhanvien/{idNhanien}',[ThongKeController::class,'layhoadontheonhanvien']);
    
    Route::get('/phim/layhoadontheokhoangthoigian/{ngaybd}/{ngaykt}',[ThongKeController::class,'layhoadontheokhoangthoigian']);
    //các route của khách hàng
    
});
Route::get('/theloai-trangchu',[TheLoaiController::class,'index']);
Route::get('/k/{k}',[VeController::class,'test']);