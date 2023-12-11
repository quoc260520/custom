<?php

namespace App\Http\Controllers\LichChieu;

use App\Http\Controllers\Controller;
use App\Models\DinhDangPhim;
use App\Models\LichChieu;
use App\Models\Phim;
use App\Models\PhongChieu;
use App\Models\Ve;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
class LichChieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lichchieu = LichChieu::join('PhongChieu', 'PhongChieu.idPhongChieu', '=', 'LichChieu.idPhong')
        ->join('Phim', 'Phim.idPhim', '=', 'LichChieu.idPhim')
        ->select('LichChieu.*', 'Phim.TenPhim', 'PhongChieu.TenPhong')
        ->get();
        return response()->json($lichchieu);
    }
    public function get_update($id)
    {
        try{
          
            $phongchieu=PhongChieu::all();
            $lichchieu=LichChieu::where('idLichChieu',$id)->get();
            return view('LichChieu.LichChieu_update',['phongchieu'=>$phongchieu,'lichchieu'=>$lichchieu]);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_create(){
        $phim=Phim::all();
        return view('Admin.Home.create_phim',['phim'=>$phim]);
    }

    public function danhSachPhongChieuTrongKhoangThoiGian($thoiGianChieu, $idphim)
    {
        $phim = Phim::where('idPhim', $idphim)->first();
        // Tính thời gian kết thúc dựa trên thời gian chiếu và thời lượng phim
        $thoiGianChieu = DateTime::createFromFormat('Y-m-d H:i', $thoiGianChieu);
       
        $thoiGianKetThuc = clone $thoiGianChieu;
        $thoiGianKetThuc->add(new DateInterval('PT' . ($phim->ThoiLuong + 10) . 'M'));
        $currentDateTimeDB = $thoiGianChieu->format('Y-m-d H:i:s');
        $currentDateTimeKT= $thoiGianKetThuc->format('Y-m-d H:i:s');

        
    
        // Lấy danh sách phòng không có lịch chiếu trong khoảng thời gian chỉ định
        $phongChieus = PhongChieu::whereNotExists(function ($query) use ($currentDateTimeDB, $currentDateTimeKT) {
            $query->select(DB::raw(1))
                ->from('LichChieu')
                ->whereColumn('PhongChieu.idPhongChieu', 'LichChieu.idPhong')
                ->where(function ($subQuery) use ($currentDateTimeDB, $currentDateTimeKT) {
                    $subQuery->where(function ($q) use ($currentDateTimeDB) {
                        $q->where('LichChieu.ThoiGianChieu', '<=', $currentDateTimeDB)
                            ->where('LichChieu.ThoiGianKetThuc', '>=', $currentDateTimeDB);
                    })->orWhere(function ($q) use ($currentDateTimeKT) {
                        $q->where('LichChieu.ThoiGianChieu', '<=', $currentDateTimeKT)
                            ->where('LichChieu.ThoiGianKetThuc', '>=', $currentDateTimeKT);
                    })->orWhere(function ($q) use ($currentDateTimeDB, $currentDateTimeKT) {
                        $q->where('LichChieu.ThoiGianChieu', '>=', $currentDateTimeDB)
                            ->where('LichChieu.ThoiGianKetThuc', '<=', $currentDateTimeKT);
                    });
                });
        })->
        where('idManHinh',$phim->idMH)->get();
        
        $lichChieus = LichChieu::selectRaw('TIME(ThoiGianChieu) as ThoiGianChieu, TIME(ThoiGianKetThuc) as ThoiGianKetThuc, idPhong,idLichChieu')
        ->where('idPhim', $idphim)
      
        ->get();
    
        return response()->json(['phongchieu' => $phongChieus,'phims'=>$phim]);
    }
    
    
    public function tao(Request $request)
    {
     
        
            // Kiểm tra tồn tại của phòng chiếu
            $phongchieu = PhongChieu::where('idPhongChieu', $request->idphong)->first();
            $phim = Phim::where('idPhim', $request->selectedPhimId)->first();
            if (!$phongchieu) {
                return response()->json(['message' => 'Phòng chiếu không tồn tại'], 404);
            }
            if (!$phim) {
                return response()->json(['message' => 'phim chiếu không tồn tại'], 404);
            }
            // Sử dụng transaction để đảm bảo tính nhất quán
            $thoiGianChieu = DateTime::createFromFormat('Y-m-d H:i', $request->thoiGianChieuValue);
       
            $thoiGianKetThuc = clone $thoiGianChieu;
            $thoiGianKetThuc->add(new DateInterval('PT' . ($phim->ThoiLuong + 10) . 'M'));
            $currentDateTimeDB = $thoiGianChieu->format('Y-m-d H:i:s');
            $currentDateTimeKT= $thoiGianKetThuc->format('Y-m-d H:i:s');
            try {
                // Các bước kiểm tra, tính toán khác ở đây
            
                $phim = new LichChieu();
                $phim->ThoiGianChieu = $currentDateTimeDB;
                $phim->ThoiGianKetThuc = $currentDateTimeKT;
          
                $phim->idPhong = $request->idphong;
                $phim->idPhim = $request->selectedPhimId;
            
                // Bắt đầu try cho phần save
                try {
                    $phim->save();
                    return response()->json(['message' => 'Thêm lịch chiếu thành công']);
                } catch (Exception $e) {
                    // Xử lý ngoại lệ khi save thất bại
                    return response()->json(['message' => 'Lưu lịch chiếu thất bại', 'error' => $e->getMessage()], 500);
                }
            } catch (Exception $e) {
                return response()->json(['message' => 'Thêm lịch chiếu không thành công', 'error' => $e->getMessage()], 404);
            }
            
        
        
    }
    
    
    public function update(Request $request)
    {
       
        try{
            
            $phim = LichChieu::where('idLichChieu', $request->idLichChieu)->first();
            $phim->ThoiGianChieu=$request->ThoiGianChieu;
            $phim->GiaVe=$request->GiaVe;
            $phim->TrangThai=$request->TrangThai;
            $phim->idPhong=$request->idPhong;
            $phim->idDinhDang=$request->idDinhDang;
            $phim->save();
            return response()->json(['message' => 'sửa lịch chiếu thành công']);
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
            LichChieu::where('idLichChieu', $id)->delete();
            return response()->json(['message' => 'xóa lịch chiếu thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
