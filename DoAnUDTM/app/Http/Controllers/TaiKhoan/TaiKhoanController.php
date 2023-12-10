<?php
namespace App\Http\Controllers\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Session;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $tenDangNhap = $req->usernamelogin;
        $matKhau = $req->passwordlogin;

        // Tìm người dùng bằng tên đăng nhập
        $user = NguoiDung::where('TenDangNhap', $tenDangNhap)->first();

        if ($user!=null) {

            if (Hash::check($matKhau,$user->MatKhau)) {
                Auth::guard("web")->login($user);

                return redirect('/trangchu');

                // return view("Home.TrangChu",["user"=>Auth::guard("web")->user()]);
            } else {

                return redirect('/fhsjhkhd');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $tendangky=$req->UserName;
        $mk = bcrypt($req->Pass);
        DB::table('taikhoan')->insert([
            'TenDangNhap' => $tendangky,
            'MatKhau' =>$mk,

        ]);
        return redirect('/trangchu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dangxuat()
    {
        Auth::guard("web")->logout(); // Đăng xuất người dùng

        return redirect('/trangchu'); // Chuyển hướng về trang chính hoặc trang đăng nhập
    }
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
    public function login(Request $req)
    {
        $tenDangNhap = $req->UserName;
        $matKhau = $req->Pass;

        // Tìm người dùng bằng tên đăng nhập
        $user = NguoiDung::where('TenDangNhap', $tenDangNhap)->first();
        dd("óiad");
        if ($user!=null) {
            if (Hash::check($matKhau,$user->MatKhau)) {

                Auth::guard("web")->login($user);

                dd(Auth::user()->TenDangNhap);
                return redirect('/');
            } else {

                return redirect('/');
            }
        }
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
