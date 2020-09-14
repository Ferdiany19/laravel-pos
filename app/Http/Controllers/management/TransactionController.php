<?php

namespace App\Http\Controllers\management;

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
use App\Exports\StockInExport;
use App\Exports\StockReturExport;

class TransactionController extends Controller
{
    public function stockIn_export_pdf()
    {
        $items = Item::all();
        $pdf =  PDF::loadView('pdf.pdfStockIn',['items' => $items])->setPaper('a4','Landscape');
        return $pdf->download('stockIn.pdf');
    }

    public function stockIn_export_excel()
    {
        return Excel::download(new StockInExport, 'stockin.xlsx');
    }

    /* stock in index ini adalah tampilan get*/
    public function stock_in(){
        $items = Item::all();
        return view('management.transaction.stockIn')->with([
            'items' => $items
        ]);
    }

    /* stock in create ini adalah tampilan get*/
    public function stock_in_create(){
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('management.transaction.addStockIn')->with([
            'items' => $items,
            'suppliers' => $suppliers
        ]);
    }


    /* stock in store ini adalaah proses create / insert / post*/
    public function stock_in_store(Request $request){
        $this->validate($request,[
            'name' => 'required|exists:items,id',
            'supplier' => 'required|exists:suppliers,id',
            'stock' => 'required|min:1',
            'price' => 'numeric|min:1|nullable',
            'expire' => 'required|date'
        ]);
        DB::beginTransaction();
        try{
            StockItem::create([
                'item_id' => $request->name,
                'supplier_id' => $request->supplier,
                'stock' => $request->stock,
                'user_id' => Auth::id(),
                'price' => $request->price,
                'expire' => $request->expire
            ]);
            DB::commit();
            return redirect()->route('management.transaction.stockIn.index')->with('success','data stock berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /* stock in show yang ingin di edit ini adalah tampilan get */
    public function stock_in_show($id){
        $items = Item::all();
        $suppliers = Supplier::all();
        $stock = StockItem::findOrfail($id);
        return view('management.transaction.editStockIn')->with([
            'items' => $items,
            'suppliers' => $suppliers,
            'stock' => $stock
        ]);
    }

    /* stock in update / edit ini adalah proses update */
    public function stock_in_edit(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|exists:items,id',
            'supplier' => 'required|exists:suppliers,id',
            'stock' => 'required|numeric|min:1',
            'price' => 'numeric|min:1|nullable',
            'expire' => 'required|date'
        ]);
        DB::beginTransaction();
        try{
            StockItem::findOrfail($id)->update([
                'item_id' => $request->name,
                'supplier_id' => $request->supplier,
                'stock' => $request->stock,
                'expire' => $request->expire
            ]);
            DB::commit();
            return redirect()->route('management.transaction.stockIn.index')->with('success','data stock berhasil di perbarui');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    /* stock in destroy ini adalah proses delete */
    public function stock_in_destroy($id){
        DB::beginTransaction();
        try{
            $stock_in = StockItem::findOrfail($id);
            $stock_in->delete();
            DB::commit();
            return back()->with('success','data stock berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function stock_retur_index(){
        $stock_returs = StockRetur::all();
        return view('management.transaction.stockRetur')->with([
            'stock_returs' => $stock_returs
        ]);
    }

    public function stock_retur_store_stock_in(Request $request,$id){
        $this->validate($request,[
            'stock' => 'required|numeric|min:1',
            'description' => 'required'
        ]);
        DB::beginTransaction();
        try{
            $stock_item = StockItem::findOrfail($id);
            $stock_sesudah_retur = $stock_item->stock - $request->stock;
            if($stock_sesudah_retur < 0 ){
                return back()->with('error', 'maaf stock yang di retur lebih dari yang dimiliki');
            }
            StockRetur::create([
                'invoice' => null,
                'item_id' => $stock_item->items()->first()->id ?? null,
                'item_name' => $stock_item->items()->first()->name,
                'supplier_name' => $stock_item->suppliers()->first()->name,
                'user_name' => User::findOrfail(Auth::id())->user_profiles()->first()->fullname,
                'customer_name' => null,
                'stock' => $request->stock,
                'expire' => $stock_item->expire,
                'price' => ($stock_item->price / $stock_item->stock) * $request->stock,
                'description' => $request->description,
                'retur_dari' => 'g',
                'pengecekan' => 'p'
            ]);
            
            if($stock_sesudah_retur > 0){
                $stock_item->update([
                    'stock' => $stock_sesudah_retur
                    ]);
            }else{
                $stock_item->delete();
            }
            DB::commit();
            return back()->with('success','Barang ' . $stock_item->items()->first()->name . ' berhasil di retur sejumlah ' . $request->stock);
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
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function update_proses(Request $request,$id){
        $this->validate($request,[
            'proses' => 'in:ta,tk'
        ]);
        DB::beginTransaction();
        try{
            $stock_retur = StockRetur::findOrfail($id);
            $stock_retur->update([
                'pengecekan' => $request->proses
            ]);
            DB::commit();
            return back()->with('success','data berhasil di update');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function stock_retur_destroy($id){
        DB::beginTransaction();
        try{
            $stock_retur = StockRetur::findOrfail($id);
            $stock_retur->delete();
            DB::commit();
            return back()->with('success','data berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function stockRetur_export_pdf()
    {
        $stock_returs = StockRetur::all();
        $pdf = PDF::loadView('pdf.pdfStockRetur',['stock_returs' => $stock_returs])->setPaper('a4','Landscape');
        return $pdf->download('stockretur.pdf');
    }

    public function stockRetur_export_excel()
    {
        return Excel::download(new StockReturExport, 'stockretur.xlsx');
    }
}
