<?php

namespace App\Http\Controllers\ThongKe;

use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\Phim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = DB::table('Phim')
    ->leftJoin('LichChieu', 'Phim.idPhim', '=', 'LichChieu.idPhim')
    ->leftJoin('Ve', 'LichChieu.idLichChieu', '=', 'Ve.idLichChieu')
    ->leftJoin('CHITIETVE', 'Ve.idVe', '=', 'CHITIETVE.idVe')
    ->leftJoin('HOADON', 'CHITIETVE.MAHOADON', '=', 'HOADON.MAHOADON')
    ->select(
        'Phim.idPhim', 
        'Phim.TenPhim', 
        'Phim.NgayKhoiChieu',
        'Phim.Thoiluong',
        'Phim.ApPhich',
        DB::raw('COUNT(DISTINCT CHITIETVE.idVe) AS SoLuongVeBan'), 
        DB::raw('SUM(CHITIETVE.GiaVe) AS TongTienBanDuoc')
    )
    ->groupBy('Phim.idPhim', 'Phim.TenPhim','Phim.NgayKhoiChieu','Phim.ThoiLuong','Phim.ApPhich')
    ->orderByDesc('TongTienBanDuoc')
    ->take(6)
    ->get();
    $phim=Phim::all();
    $nhanvien=NhanVien::all();

        return view('ThongKe.Home_ThongKe',['phimhot'=>$results,'nhanvien'=>$nhanvien,'phim'=>$phim]);
    }
    public function layhoadontheokhoangthoigian($ngaybd,$ngaykt)
    {
        $results = DB::table('HOADON')
        ->whereBetween('NGAYTAO', [$ngaybd,$ngaykt])
        ->get();
        $totalAmount = DB::table('HOADON')
        ->whereBetween('NGAYTAO', [$ngaybd, $ngaykt])
        ->sum('TONGTIEN');
        return response()->json(['hoadon'=>$results,'tongtien'=>$totalAmount]);
    }
    public function layhoadontheophim($idphim)
    {
        $results = DB::table('HOADON')
        ->select('HOADON.*')
        ->join('CHITIETVE', 'HOADON.MAHOADON', '=', 'CHITIETVE.MAHOADON')
        ->join('Ve', 'CHITIETVE.idVe', '=', 'Ve.idVe')
        ->join('LichChieu', 'Ve.idLichChieu', '=', 'LichChieu.idLichChieu')
        ->where('LichChieu.idPhim', $idphim)
        ->distinct()
        ->get();
        $totalSales = DB::table('HOADON')
    ->select(DB::raw('SUM(CHITIETVE.GiaVe) AS TotalSales'))
    ->join('CHITIETVE', 'HOADON.MAHOADON', '=', 'CHITIETVE.MAHOADON')
    ->join('Ve', 'CHITIETVE.idVe', '=', 'Ve.idVe')
    ->join('LichChieu', 'Ve.idLichChieu', '=', 'LichChieu.idLichChieu')
    ->where('LichChieu.idPhim', $idphim)
    ->first();

    $totalSalesAmount = $totalSales->TotalSales;
    return response()->json(['hoadon'=>$results,'tongtien'=>$totalSalesAmount]);
    }


    public function layhoadontheonhanvien($idNhanVien)
    {
        $invoices = DB::table('HOADON')
    ->select('HOADON.*')
    ->where('HOADON.MANHANVIEN', $idNhanVien)
    ->get();
    
    $tongtien = DB::table('HOADON')
    ->select(DB::raw('SUM(TONGTIEN) AS TotalAmount'))
    ->where('HOADON.MANHANVIEN', $idNhanVien)
    ->first();
    return response()->json(['hoadon'=>$invoices,'tongtien'=>$tongtien]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
