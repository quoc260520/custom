<?php

namespace App\Http\Controllers\ChucVu;

use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use Exception;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $chucvu=ChucVu::select('ChucVu.*')->get();
        return response()->json($chucvu);
    }
    public function search(Request $request)
    {
        $chucvu=ChucVu::where('TenChucVu','like','%'.$request->search.'%')->orderBy('idCV','desc')->paginate(5);
        if($chucvu->count()>=1)
        {
            return view('ChucVu.PhanTrang',compact('chucvu'))->render();
        }
        else{
            return response()->json(['msg'=>'Không có thông tin cần tìm']);
        }
    }
    public function pagination(Request $request)
    {
        $chucvu = ChucVu::orderBy('idCV', 'desc')->paginate(5);
        return view('ChucVu.PhanTrang',compact('chucvu'))->render();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_create(){
        return view('ChucVu.ChucVu_create');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'TenChucVu'=>'required',
            
        ],
            ['TenChucVu.required'=>'Tên Chức Vụ Không Được Để Trống',
           
        ]);
        try {
            $phim = new ChucVu();
            $phim->TenChucVu=$request->TenChucVu;
       
            $phim->save();
            return response()->json(['message' => 'Thêm Chức Vụ Thành Công','phim'=>$phim]);
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
        $chucvu=ChucVu::where('idCV',$id)->get();
      
        return view('ChucVu.ChucVu_update',['chucvu'=>$chucvu]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'TenChucVu'=>'required',
           
        ],
            ['TenChucVu.required'=>'Tên Chức Vụ Không Được Để Trống',
           
        ]);
        try{
            
            $phim = ChucVu::where('idCV', $request->idCV)->first();
            $phim->TenChucVu=$request->TenChucVu;
       
            $phim->save();
            return response()->json(['message' => 'Sửa Chức Vụ Thành Công']);
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
            ChucVu::where('idCV', $id)->delete();
            return response()->json(['message' => 'xóa Chức Vụ thành công']);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
