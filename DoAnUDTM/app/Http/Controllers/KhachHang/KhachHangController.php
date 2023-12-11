<?php

namespace App\Http\Controllers\KhachHang;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(KhachHang::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getthongtincanhan()
    {
        $thongtin=KhachHang::where('idTK',Auth::user()->id)->first();
        return view('Home.ThongTinCaNhan',['thongtin'=>$thongtin]);
    }
    public function capnhathongtin(Request $request)
    {
        $thongtin=KhachHang::where('idTK',Auth::user()->id)->first();
        $thongtin->HoTen=$request->hoten;
        $thongtin->Email=$request->email;
        $thongtin->NgaySinh=$request->ngaysinh;
        $thongtin->DiaChi=$request->diachi;
        $thongtin->SDT=$request->sdt;
        $thongtin->save();
        return redirect('/thongtincanhan');
    }
    public function getdoimatkhau()
    {
        
        return view('Home.DoiMatKhau');
    }
    public function updatematkhau(Request $request)
    {
        if (Hash::check($request->matkhauhientai,Auth::user()->MatKhau)) {            
            //cái nàm này là 1 pas 1 hash pass ha gì mà
            // Đăng nhập thành công
            DB::table('taikhoan')
            ->where('id',Auth::user()->id )
            ->update([
            'MatKhau' => bcrypt($request->matkhaumoi),
     
        ]);
        Auth::guard("web")->logout();
        return redirect('/');
        
    }
}
    public function get_create()
    {
        return view('KhachHang.KhachHang_create');
    }
    public function get_update($id)
    {
        $kh=KhachHang::where('idKH',$id)->get();
        return view('KhachHang.KhachHang_update',['kh'=>$kh]);
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
            $taiKhoan = NguoiDung::create([
                'TenDangNhap' => $request->TenDangNhap, // Thay bằng thông tin tên đăng nhập thực
                'MatKhau' => bcrypt($request->MatKhau), // Thay bằng thông tin mật khẩu thực
                'TinhTrang'=>0
            ]);
            $phim = new KhachHang();
            $phim->HoTen=$request->HoTen;
            $phim->NgaySinh=$request->NgaySinh;
            $phim->DiaChi=$request->DiaChi;
            $phim->SDT=$request->SDT;
            $phim->Email=$request->Email;
            $phim->idTK=$taiKhoan->id;
            $phim->save();
            return response()->json(['message' => 'Thêm Khách Hàng Thành Công','phim'=>$phim]);
        } catch (Exception $e) {
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
            $phim =KhachHang::where('idKH', $request->idKH)->first();
            $phim->HoTen=$request->HoTen;
            $phim->NgaySinh=$request->NgaySinh;
            $phim->DiaChi=$request->DiaChi;
            $phim->SDT=$request->SDT;
            $phim->Email=$request->Email;
       
            $phim->save();
            return response()->json(['message' => 'Cập Nhật Thông Tin Thành Công','phim'=>$phim]);
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
    public function delete($id)
    {
        try{
            KhachHang::where('idKH', $id)->delete();
            return response()->json(['message' => 'xóa khách hàng thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
