<?php

namespace App\Http\Middleware;

use App\Models\KhachHang;
use App\Models\NhanVien;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $nv=NhanVien::where('idTK',Auth::user()->id)->first();
        
        if(!isset($nv))
        {
            return redirect('/');
        }
        return $next($request);
    }
}
