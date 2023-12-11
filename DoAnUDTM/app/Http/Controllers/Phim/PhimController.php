<?php

namespace App\Http\Controllers\Phim;

use App\Http\Controllers\Controller;
use App\Models\LichChieu;
use App\Models\LoaiManHinh;
use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\TheLoai;
use App\Models\ThucAn;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class PhimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phims = Phim::join('TheLoai', 'Phim.idTheLoai', '=', 'TheLoai.idTheLoai')
                    ->join('LoaiManHinh', 'Phim.idMH', '=', 'LoaiManHinh.idMH')
                    ->select('Phim.*', 'TheLoai.TenTheLoai', 'LoaiManHinh.TenMH')
                    ->get();

        return response()->json($phims);
    }
    public function getcreate()
    {
        $theloai=TheLoai::all();
        $dinhdang=LoaiManHinh::all();
        return view('Phim.Phim_create',['theloai'=>$theloai,'dinhdang'=>$dinhdang]);
    }
    public function trangchu()
    {
        $phimdangchieu = Phim::where('NgayKhoiChieu', '<=', now())->get();
        $phimsapchieu = Phim::where('NgayKhoiChieu', '>', now())->get();
        $theloai=TheLoai::all();
        $phims=Phim::all();
        return view('Home.TrangChu',['phimsapchieu'=>$phimsapchieu,'phimdangchieu'=>$phimdangchieu,'theloai'=>$theloai,'phims'=>$phims]);
    }
    
    public function phimdangchieu()
    {
        $phimdangchieu = Phim::where('NgayKhoiChieu', '<=', now())->get();
        return view('Home.PhimDangChieu',['phimdangchieu'=>$phimdangchieu]);
    }
    public function phimsapchieu()
    {
        $phimsapchieu = Phim::where('NgayKhoiChieu', '>', now())->get();
        return view('Home.PhimSapChieu',['phimsapchieu'=>$phimsapchieu]);
    }
    public function phimtheoloai($id)
    {
        $theloai=TheLoai::where('idTheLoai',$id)->get();
        $phim=Phim::where('idTheLoai',$id)->get();
        return view('Home.PhimTheoTheLoai',['theloai'=>$theloai,'phim'=>$phim]);
    }
    public function search(Request $request)
    {
        $tuKhoa=$request->tuKhoa;
        $phim = Phim::join('TheLoai', 'Phim.idTheLoai', '=', 'TheLoai.idTheLoai')
        ->where('Phim.TenPhim', 'like', '%'.$tuKhoa.'%')
        ->orWhere('TheLoai.TenTheLoai', 'like', '%'.$tuKhoa.'%')
        ->get();
        return view('Home.TimKiemPhim',['phim'=>$phim]);
    }
    public function thongtindatve($id)
    {
        $phim = Phim::join('TheLoai', 'Phim.idTheLoai', '=', 'TheLoai.idTheLoai')
        ->select('Phim.*', 'TheLoai.TenTheLoai')
        ->where('Phim.idPhim', $id) 
        ->get();

        $ngayHienTai = Carbon::now()->toDateString();
        $lichChieus = LichChieu::selectRaw('DATE(ThoiGianChieu) as NgayChieu')
        ->where('idPhim', $id)
        ->whereDate('ThoiGianChieu', '>=', $ngayHienTai) 
        ->distinct('NgayChieu')
        ->get();
        $thucan=ThucAn::all();
        // return $lichChieus;
        return view('Home.DatVe',['phim'=>$phim,'lichchieu'=>$lichChieus,'thucan'=>$thucan]);
    }
    public function laycacxuatchieu($idphim,$ngay)
    {
        $lichChieus = LichChieu::selectRaw('TIME(ThoiGianChieu) as ThoiGianChieu, TIME(ThoiGianKetThuc) as ThoiGianKetThuc, idPhong,idLichChieu')
        ->where('idPhim', $idphim)
        ->whereDate('ThoiGianChieu', $ngay)
        ->get();

        return response()->json(['xuatchieu'=>$lichChieus]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'TenPhim'=>'required',
            'MoTa'=>'required',
            'ThoiLuong'=>'required',
            'NgayKhoiChieu'=>'required',
            'HangSanXuat'=>'required',
            'DaoDien'=>'required',
            'NamSX'=>'required',
            'idTheLoai'=>'required',
        ],
            ['TenPhim.required'=>'Tên Không Được Để Trống',
            'MoTa.required'=>'Mô Tả Không Được Để Trống',
            'ThoiLuong.required'=>'Thời Lượng Không Được Để Trống',
            'NgayKhoiChieu.required'=>'Ngày Khởi Chiếu Không Được Để Trống',
            'HangSanXuat.required'=>'Hãng Sản Xuất Không Được Để Trống',
            'DaoDien.required'=>'Đạo Diễn Không Được Để Trống',
            'NamSX.required'=>'Năm Sản Xuất Không Được Để Trống',
            'idTheLoai.required'=>'Thể Loại Không Được Để Trống',
        ]);
   
        try {
            $phim = new Phim();
            $phim->TenPhim=$request->TenPhim;
            $phim->MoTa=$request->MoTa;
            $phim->ThoiLuong=$request->ThoiLuong;
            $phim->NgayKhoiChieu=$request->NgayKhoiChieu;
            $phim->HangSanXuat=$request->HangSanXuat;
            $phim->DaoDien=$request->DaoDien;
            $phim->NamSX=$request->NamSX;
            $phim->Trailerr=$request->Trailerr;
            $phim->idTheLoai=$request->idTheLoai;
            $phim->idMH=$request->idMH;
            $phim->DonGia=$request->DonGia;
            if ($request->file('anh')) {
                $file = $request->file('anh');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('assets/Image'), $filename);
                $phim->ApPhich = $filename;
            }
            $phim->save();

            return response()->json(['message' => 'Thêm bộ phim thành công']);
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
        $phim=Phim::where('idPhim',$id)->get();
        return view('Home.DetailPhim',['phim'=>$phim]);
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
        try{
            
            $phim = Phim::where('idPhim', $request->idPhim)->first();
            $phim->TenPhim=$request->TenPhim;
            $phim->MoTa=$request->MoTa;
            $phim->ThoiLuong=$request->ThoiLuong;
            $phim->NgayKhoiChieu=$request->NgayKhoiChieu;
            $phim->HangSanXuat=$request->HangSanXuat;
            $phim->DaoDien=$request->DaoDien;
            $phim->NamSX=$request->NamSX;
            $phim->idTheLoai=$request->idTheLoai;
            $phim->idMH=$request->idMH;
            $phim->DonGia=$request->DonGia;
            if ($request->file('anh')) {
                $file = $request->file('anh');
                $filename =$file->getClientOriginalName();
                $file->move(public_path('assets/Image'), $filename);
                $phim->ApPhich = $filename;
            }
            $phim->save();
            return response()->json(['message' => 'sửa bộ phim thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    public function get_create(){
        $loaiphim=TheLoai::all();
        return view('Phim.Phim_create',['loaiphim'=>$loaiphim,'loaimanhinh'=>LoaiManHinh::all()]);
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
    public function get_update($id)
    {
        try{
            $loaiphim=TheLoai::all();
            $dinhdang=LoaiManHinh::all();
            $phim=Phim::where('idPhim',$id)->get();
     
            return view('Phim.Phim_update',['loaiphim'=>$loaiphim,'phim'=>$phim,'dinhdang'=>$dinhdang]);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        try{
            Phim::where('idPhim', $id)->delete();
            return response()->json(['message' => 'xóa bộ phim thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    public function createAndSuggestLichChieu(Request $request)
{
    // Xác thực dữ liệu từ request
    
    $phim = new Phim();
    $phim->TenPhim=$request->TenPhim;
    $phim->MoTa=$request->MoTa;
    $phim->ThoiLuong=$request->ThoiLuong;
    $phim->NgayKhoiChieu=$request->NgayKhoiChieu;
    $phim->HangSanXuat=$request->HangSanXuat;
    $phim->DaoDien=$request->DaoDien;
    $phim->NamSX=$request->NamSX;
    $phim->idTheLoai=$request->idTheLoai;
    $phim->idMH=$request->idMH;
    if ($request->file('anh')) {
        $file = $request->file('anh');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('assets/Image'), $filename);
        $phim->ApPhich = $filename;
    }
    $idMH=$request->idMH;
  


    // Thêm phim mới vào DB từ dữ liệu đã được xác thực
   $phim->save();

    // Gợi ý lịch chiếu cho 7 ngày tiếp theo sau thời gian khởi chiếu
    $ngayKhoiChieu = Carbon::parse($request->NgayKhoiChieu);
    $thoiLuongPhim = $request->ThoiLuong; // Thời lượng phim (đơn vị: phút)
    $thoiGianKetThuc = $ngayKhoiChieu->copy()->addMinutes($thoiLuongPhim);

    $lichChieuSuggestions = [];
    for ($i = 0; $i < 7; $i++) {
        // Lấy danh sách các phòng chiếu thích hợp
        $phongChieus = PhongChieu::where('idManHinh', $request->idMH)->get();

        foreach ($phongChieus as $phongChieu) {
            $lichChieus = LichChieu::where('idPhong', $phongChieu->idPhongChieu)
                ->where(function ($query) use ($ngayKhoiChieu, $thoiGianKetThuc) {
                    $query->where(function ($q) use ($ngayKhoiChieu, $thoiGianKetThuc) {
                        $q->where('ThoiGianChieu', '>=', $ngayKhoiChieu)
                            ->where('ThoiGianChieu', '<', $thoiGianKetThuc);
                    })->orWhere(function ($q) use ($ngayKhoiChieu, $thoiGianKetThuc) {
                        $q->where('ThoiGianKetThuc', '>', $ngayKhoiChieu)
                            ->where('ThoiGianKetThuc', '<=', $thoiGianKetThuc);
                    })->orWhere(function ($q) use ($ngayKhoiChieu, $thoiGianKetThuc) {
                        $q->where('ThoiGianChieu', '<', $ngayKhoiChieu)
                            ->where('ThoiGianKetThuc', '>', $thoiGianKetThuc);
                    });
                })->get();

            // Kiểm tra xem có lịch chiếu nào trong khoảng thời gian này không
            if ($lichChieus->isEmpty()) {
                // Nếu không có, thêm vào danh sách gợi ý
                $lichChieuSuggestions[] = [
                    'PhongChieu' => $phongChieu->TenPhong,
                    'NgayChieu' => $ngayKhoiChieu->toDateString(),
                    'ThoiGianChieu' => $ngayKhoiChieu->format('H:i'),
                    'ThoiGianKetThuc' => $thoiGianKetThuc->format('H:i')
                ];
            }
        }

        // Tăng ngày để kiểm tra tiếp theo
        $ngayKhoiChieu->addDay();
        // Cập nhật thời gian kết thúc cho ngày tiếp theo
        $thoiGianKetThuc->addDay();
    }
    dd($lichChieuSuggestions);
    // Trả về thông tin phim vừa thêm và danh sách gợi ý lịch chiếu
    return response()->json([
        'success' => true,
        'lichChieuSuggestions' => $lichChieuSuggestions
    ], 201);
}

   
}
