<?php

namespace App\Http\Controllers\DienVien;

use App\Http\Controllers\Controller;
use App\Models\DienVien;
use App\Models\Phim;
use Exception;
use Illuminate\Http\Request;

class DienVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dienvien = DienVien::join('Phim', 'Phim.idPhim', '=', 'DienVien.idPhim')
            
                    ->select('DienVien.*', 'Phim.TenPhim')
                    ->get();
        return response()->json($dienvien);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_create(){
        $phim=Phim::all();
        return view('DienVien.DienVien_create',['phim'=>$phim]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'TENDV'=>'required',
            
        ],
            ['TENDV.required'=>'Tên Diễn viên Không Được Để Trống',
           
        ]);
        try {
            $phim = new DienVien();
            $phim->TENDV=$request->TENDV;
            $phim->MOTA=$request->MOTA;
            $phim->idPhim=$request->idPhim;
            $phim->save();
            return response()->json(['message' => 'Thêm diễn viên thành công','phim'=>$phim]);
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
    public function get_update($id){
        $dienvien=DienVien::where('MADV',$id)->get();
        $phim=Phim::all();
        return view('DienVien.DienVien_update',['dienvien'=>$dienvien,'phim'=>$phim]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'TENDV'=>'required',
           
        ],
            ['TENDV.required'=>'Tên Thức Ăn Không Được Để Trống',
           
        ]);
        try{
            
            $phim = DienVien::where('MADV', $request->MADV)->first();
            $phim->TENDV=$request->TENDV;
            $phim->MOTA=$request->MOTA;
            $phim->idPhim=$request->idPhim;
            $phim->save();
       
           
            return response()->json(['message' => 'Cập nhật thông tin diễn viên thành công']);
        }
        catch(Exception $e)
        {
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
            DienVien::where('MADV', $id)->delete();
            return response()->json(['message' => 'xóa Chức Vụ thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
