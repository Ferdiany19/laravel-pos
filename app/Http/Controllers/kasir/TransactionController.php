<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use App\models\Customer;
use App\models\Item;
use App\models\Order;
use App\models\OrderDetail;
use App\models\StockItem;
use App\models\StockRetur;
use App\models\Supplier;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockOutExport;

class TransactionController extends Controller
{
    /* order create ini adalah tampilan get */
    public function order_create(){
        $customers = Customer::all();
        $items = Item::all();
        $order_details = OrderDetail::all();
        $items_barcode = $items->implode('barcode','","');
        return view('kasir.transaction.sales')->with([
            'customers' => $customers,
            'items_barcode' => $items_barcode,
            'order_details' => $order_details
        ]);
    }

    public function view($id) {
        $order = Order::find($id);
        $tgl = $tgl = date('d F Y H:i:s');
        return view('kasir.transaction.view', compact('order', 'tgl'));
    }


    /* order store ini adalah proses post store */
    public function order_store(Request $request){
        /* validate request customer dan uang_customer */
        $this->validate($request,[
            'customer' => 'required|exists:customers,id',
            'uang_customer' => 'required|numeric|min:1',
            'item_id' => 'required'
        ]);
        /* validasi item_id harus di ubah ke request terlebih dahulu */
        foreach($request->item_id as $item_validate){
            $request_validate_item = new Request($item_validate);
            $this->validate($request_validate_item,[
            'item_id' => 'required|exists:items,barcode',
            'stock' => 'required|numeric|min:1'
            ]);
        }

        $items = $request->item_id; // ambil semua item
        $items = collect($items); // masukan ke method collect
        $items = $items->groupBy('item_id'); // di groupkan yang sama
        $item_group = []; // buat array
        $i = 0; // untuk key array item group
        /* memasukan data ke item group */
        foreach($items as $item){
            $item_group[$i]['barcode'] = $item->first()['item_id'];
            $item_group[$i]['stock'] = $item->sum('stock');
            $i++;
        }
        $item_group = collect($item_group); //masukkan ke collect untuk pemakain semua fitur collect dan membuat menjadi objek dan data inilah yang di simpan ke order detail

        /* untuk menentukan jumlah yang harus di bayar oleh pembeli */
        $jumlah_dibayar = 0;
        foreach($item_group as $item){
            $price = Item::where('barcode', $item['barcode'])->first()->price;
            $price = $price * $item['stock'];
            $jumlah_dibayar = $jumlah_dibayar + $price; 
        }
        /* pengecekan apakah uang cutomer kurang dari di bayar */
        if(($request->uang_customer - $jumlah_dibayar) < 0){
            return back()->with('error','maaf uang customer kurang silahkan ulang kembali');
        }
        DB::beginTransaction();
        try{
            /* pengecekan apakah salah satu dari item stock gudang mencukupi stock yang diminta oleh customer */
            foreach($item_group as $item){
                $item_real = Item::where('barcode',$item['barcode'])->first();
                $stock = $item_real->stock_items()->get()->sum('stock');
                if($item['stock'] > $stock){
                    return back()->with('error','stock ' . $item_real->name . ' tidak mencukupi stock yang diinginkan customer');
                }
            }

            /* membuat order invoice di nullkan terlebih dahulu ( create store )*/
            $order = Order::create([
                'customer_id' => $request->customer,
                'user_id' => Auth::id(),
            ]);

            /* memasukan invoice sesuai id ( update )*/
            $invoice = str_pad($order->id,10,"0",STR_PAD_LEFT);
            $order->update([
                'invoice' => $invoice
            ]);

            /* pengecekan metode apakah yang di pakai setiap barang*/
            foreach($item_group as $item){
                $item_real = Item::where('barcode',$item['barcode'])->first();
                if($item_real->method_stock === "fifo"){
                    $laba = $this->fifo($item_real->stock_items()->get(),$item['stock']);
                }else{
                    $laba = $this->lifo($item_real->stock_items()->get(),$item['stock']);
                }

                /* membuat order detail item  */
                $item_real = Item::where('barcode',$item['barcode'])->first();
                OrderDetail::create([
                    'order_id' => $order->id,
                    'item_id' => $item_real->id,
                    'qty' => $item['stock'],
                    'price' => $item_real->price * $item['stock'],
                    'laba' => $laba,
                    'jumlah_dibayar' => $jumlah_dibayar
                ]);
            }
            DB::commit();
            // dd($request->all()); /
            return back()->with('success','data order customer berhasil silahkan cek ke menu stock out');
            // return redirect('transaction/view{id}');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }


    /* function yang digunakn untuk search barang sesuai barcode */
    public function source_id(Request $request){
        $item = Item::where('barcode',$request->barcode)->firstOrFail();
        $stock_item = $item->stock_items()->sum('stock');
        return [$item,$stock_item];
    }

    /* metode fifo untuk barang expire terlebih dahulu */
    public function fifo($stock_ada,$diminta){
        $tersedia = $stock_ada->sum('stock');
        $stock_ada = $stock_ada->sortBy('expire');
        $stock_ada = json_decode($stock_ada);
        $laba = 0;
        try{
            if($tersedia >= $diminta){
                foreach($stock_ada as $stock){
                    $punya = $diminta - $stock->stock;
                    if($punya > 0){
                        $stock_item = StockItem::findOrfail($stock->id);
                        $harga_seluruh_item = $stock_item->items()->first()->price * $stock_item->stock;
                        $laba = $harga_seluruh_item - $stock_item->price + $laba;
                        $stock_item->delete();
                        $diminta = $punya;
                    }elseif($punya == 0){
                        $stock_item =  StockItem::findOrfail($stock->id);
                        $harga_seluruh_item = $stock_item->items()->first()->price * $stock_item->stock;
                        $laba = $harga_seluruh_item - $stock_item->price + $laba;
                        $stock_item->delete();
                        break;
                    }else{
                        $stock_item = StockItem::findOrfail($stock->id);
                        $punya = preg_replace('/[^0-9]/', '', $punya);
                        $harga_seluruh_item = $stock_item->items()->first()->price * $diminta;
                        $laba =  $harga_seluruh_item - (($stock_item->price / $stock_item->stock) * $diminta) + $laba;
                        $stock_item->update([
                            'stock' => $punya,
                            'price' => $stock_item->price - (($stock_item->price / $stock_item->stock) * $diminta)
                        ]);
                        break;
                    }
                }
            }else{
                return back('error','persedian stock kurang dari diminta customer');
            }
            return $laba;
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    /* metode lifo untuk data yang terakhir masuk atau terakhir expire yang di dahulukan di jual */
    public function lifo($stock_ada,$diminta){
        $tersedia = $stock_ada->sum('stock');
        $stock_ada = $stock_ada->sortByDesc('expire');
        $stock_ada = json_decode($stock_ada);
        $laba = 0;
        try{
            if($tersedia >= $diminta){
                foreach($stock_ada as $stock){
                    $punya = $diminta - $stock->stock;
                    if($punya > 0){
                        $stock_item = StockItem::findOrfail($stock->id);
                        $harga_seluruh_item = $stock_item->items()->first()->price * $stock_item->stock;
                        $laba = $harga_seluruh_item - $stock_item->price + $laba;
                        $stock_item->delete();
                        $diminta = $punya;
                    }elseif($punya == 0){
                        $stock_item =  StockItem::findOrfail($stock->id);
                        $harga_seluruh_item = $stock_item->items()->first()->price * $stock_item->stock;
                        $laba = $harga_seluruh_item - $stock_item->price + $laba;
                        $stock_item->delete();
                        break;
                    }else{
                        $stock_item = StockItem::findOrfail($stock->id);
                        $punya = preg_replace('/[^0-9]/', '', $punya);
                        $harga_seluruh_item = $stock_item->items()->first()->price * $diminta;
                        $laba =  $harga_seluruh_item - (($stock_item->price / $stock_item->stock) * $diminta) + $laba;
                        $stock_item->update([
                            'stock' => $punya,
                            'price' => $stock_item->price - (($stock_item->price / $stock_item->stock) * $diminta)
                        ]);
                        break;
                    }
                }
            }else{
                return back('error','persedian stock kurang dari diminta customer');
            }
            return $laba;
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function stock_out_index(){
        $orders = Order::all();
        return view('kasir.transaction.stockOut')->with([
            'orders' => $orders
        ]);
    }
    
    public function stock_out_destroy($id){
        $order_stock = OrderDetail::findOrfail($id);
        DB::beginTransaction();
        try{
            $order_stock->delete();
            $order = $order_stock->orders()->first();
            /* pengecekan apakah data order masih ada data order detailnya */
            if(count($order->order_details()->get()) < '1'){
                $order->delete();
            }
            DB::commit();
            return back()->with('success','data stock berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function stock_retur_store_stock_out(Request $request, $id){
        $this->validate($request,[
            'retur' => 'required|numeric|min:1',
            'description' => 'required',
        ]);

        DB::beginTransaction();
        try{
            $order_detail = OrderDetail::findOrfail($id);
            $stock_sesudah_retur = $order_detail->qty - $request->retur;
            if($stock_sesudah_retur < 0){
                return back()->with('error','maaf stock retur melebihi yang di beli oleh customer');
            }
            StockRetur::create([
                'invoice' => $order_detail->orders()->first()->invoice,
                'item_id' => $order_detail->items()->first()->id ?? null,
                'item_name' => $order_detail->items()->first()->name,
                'supplier_name' => $request->supplier,
                'user_name' => User::findOrfail(Auth::id())->user_profiles()->first()->fullname,
                'customer_name' => $order_detail->orders()->first()->customers()->first()->name,
                'stock' => $request->retur,
                'price' => ($order_detail->price / $order_detail->qty) * $request->retur,
                'description' => $request->description,
                'retur_dari' => 'c',
                'pengecekan' => 'p'
            ]);
            DB::commit();
            return back()->with('success','Barang '. $order_detail->items()->first()->name . ' berhasil di retur sejumlah ' . $request->retur );
            // return 'transaction.view';
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function stockOut_export_pdf()
    {
        $orders = Order::all();
        $pdf = PDF::loadView('pdf.pdfStockOut',['orders' => $orders])->setPaper('a4','Landscape');
        return $pdf->download('stockOut.pdf');
    }

    public function stockOut_export_excel()
    {
        return Excel::download(new StockOutExport, 'stockout.xlsx');
    }
}
