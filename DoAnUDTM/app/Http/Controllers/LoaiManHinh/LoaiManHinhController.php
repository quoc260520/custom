<?php

namespace App\Http\Controllers\LoaiManHinh;

use App\Http\Controllers\Controller;
use App\Models\LoaiManHinh;
use Exception;
use Illuminate\Http\Request;

class LoaiManHinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(LoaiManHinh::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_create(){
        return view('LoaiManHinh.LoaiManHinh_create');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'TenMH'=>'required',
            
        ],
            ['TenMH.required'=>'Tên màn h Không Được Để Trống',
           
        ]);
        try {
            $phim = new LoaiManHinh();
            $phim->TenMH=$request->TenMH;
       
            $phim->save();
            return response()->json(['message' => 'Thêm màn hình thành công','phim'=>$phim]);
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
    public function get_update($id)
    {
        $manhinh=LoaiManHinh::where('idMH',$id)->get();
        return view('LoaiManHinh.LoaiManHinh_update',['manhinh'=>$manhinh]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'TenMH'=>'required',
           
        ],
            ['TenMH.required'=>'Tên màn hình Không Được Để Trống',
           
        ]);
        try{
            
            $phim = LoaiManHinh::where('idMH', $request->idMH)->first();
            $phim->TenMH=$request->TenMH;
       
            $phim->save();
            return response()->json(['message' => 'Cập nhật thông tin thành công']);
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
            LoaiManHinh::where('idMH', $id)->delete();
            return response()->json(['message' => 'xóa màn hình thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
