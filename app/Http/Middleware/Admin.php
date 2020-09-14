<?php

namespace App\Http\Middleware;

use App\models\StockRetur;
use App\models\StockItem;
use App\User;
use Auth;
use Carbon\Carbon;
use Closure;
use Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::findOrfail(Auth::id())->role_users()->first()->name;
        $stock_return_proses = StockRetur::where('pengecekan','p')->get();
        $barangs = StockItem::all()->sortBy('expire');
        $barang_expire = [];
        $i = 0;
        foreach($barangs as $barang){
            $hari_ini = Carbon::now()->setTime(0,0,0);
            $exp = Carbon::parse($barang->expire);
            $diff_in_days = $hari_ini->diffInDays($exp);
            if( $diff_in_days <= $barang->items()->first()->warning_expire){
                if($hari_ini == $exp){
                    $barang_expire[$i] = $barang;
                    $barang_expire[$i]['message'] = "hari ini kadaluarsa";
                    $barang_expire[$i++]['bg_alert'] = "btn-danger";
                }
                else if($hari_ini > $exp){
                    $barang_expire[$i] = $barang;
                    $barang_expire[$i]['message'] = "sudah kadaluarsa";
                    $barang_expire[$i++]['bg_alert'] = "btn-dark";
                }
                else{
                    $barang_expire[$i] = $barang;
                    $barang_expire[$i]['message'] = "akan kadaluarsa $diff_in_days hari lagi";
                    $barang_expire[$i++]['bg_alert'] = "btn-danger";
                }
            }
        }
        if($user === 'Admin'){
            Session::flash('stock_return_proses',$stock_return_proses);
            Session::flash('barang_expire',$barang_expire);
            return $next($request);
        }
        return abort(403,'ini untuk halaman admin');
    }
}
