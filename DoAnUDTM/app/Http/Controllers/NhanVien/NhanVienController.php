<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use App\Models\NguoiDung;
use App\Models\NhanVien;
use Exception;
use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(NhanVien::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_create()
    {
        $chucvu=ChucVu::all();
        return view('NhanVien.NhanVien_create',['chucvu'=>$chucvu]);
    }
    public function get_update($id)
    {
        $kh=NhanVien::where('idNhanVien',$id)->get();
        $chucvu=ChucVu::all();
        return view('NhanVien.NhanVien_update',['nhanvien'=>$kh,'chucvu'=>$chucvu]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'HoTen'=>'required',
            'NgaySinh'=>'required',
            'DiaChi'=>'required',
            'SDT'=>'required',
          
          
        ],
            ['HoTen.required'=>'Tên Không Được Để Trống',
            'NgaySinh.required'=>'Ngày Sinh Không Được Để Trống',
            'DiaChi.required'=>'Địa Chỉ Không Được Để Trống',
            'SDT.required'=>'Số Điện Thoại Không Được Để Trống',
            
      
        ]);
        try {
            // Tạo tài khoản
            $taiKhoan = NguoiDung::create([
                'TenDangNhap' => $request->TenDangNhap, // Thay bằng thông tin tên đăng nhập thực
                'MatKhau' => bcrypt($request->MatKhau), // Thay bằng thông tin mật khẩu thực
                'TinhTrang'=>0
            ]);




            $phim = new NhanVien();
            $phim->HoTen=$request->HoTen;
            $phim->NgaySinh=$request->NgaySinh;
            $phim->DiaChi=$request->DiaChi;
            $phim->SDT=$request->SDT;
            $phim->Email=$request->Email;
            $phim->idChucVu=$request->idChucVu;
            $phim->GioiTinh=$request->gioitinh;
            $phim->idTK=$taiKhoan->id;
            $phim->save();
            return response()->json(['message' => 'Thêm Nhân Viên Thành Công','phim'=>$phim]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try{
            NhanVien::where('idNhanVien', $id)->delete();
            return response()->json(['message' => 'xóa nhân viên thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
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
    public function update(Request $request)
    {
        $request->validate([
            'HoTen'=>'required',
            'NgaySinh'=>'required',
            'DiaChi'=>'required',
            'SDT'=>'required',
          
          
        ],
            ['HoTen.required'=>'Tên Không Được Để Trống',
            'NgaySinh.required'=>'Ngày Sinh Không Được Để Trống',
            'DiaChi.required'=>'Địa Chỉ Không Được Để Trống',
            'SDT.required'=>'Số Điện Thoại Không Được Để Trống',
            
      
        ]);
        try {
            $phim =NhanVien::where('idNhanVien', $request->idNhanVien)->first();
            $phim->HoTen=$request->HoTen;
            $phim->NgaySinh=$request->NgaySinh;
            $phim->DiaChi=$request->DiaChi;
            $phim->SDT=$request->SDT;
            $phim->Email=$request->Email;
            $phim->idChucVu=$request->idChucVu;
            $phim->GioiTinh=$request->gioitinh;
            $phim->save();
            return response()->json(['message' => 'Sửa Nhân Viên Thành Công','phim'=>$phim]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
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
