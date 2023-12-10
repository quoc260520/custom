<?php

namespace App\Http\Controllers\HoaDon;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HoaDonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoadon = HoaDon::join('Khachhang', 'KhachHang.idKH', '=', 'HoaDon.MAKHACHHANG')
                   
                    ->select('HoaDon.*', 'KhachHang.HoTen', 'KhachHang.SDT')
                    ->get();
        return response()->json($hoadon);
    }
    public function nhanve($id)
    {
        $hoadon = HoaDon::where('MAHOADON', $id)->first(); 

        if ($hoadon) {
            
            $hoadon->TinhTrang = 1; 
            
            $hoadon->save(); 

           
            return back();
        } else {
           
            return "Không tìm thấy hóa đơn với MAHOADON = $id";
        }
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
