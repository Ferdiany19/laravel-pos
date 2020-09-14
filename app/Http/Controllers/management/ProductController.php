<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use Exception;
use App\models\Item;
use App\models\Unit;
use App\models\Category;
use App\models\Supplier;
use Barryvdh\DomPDF\Facade as PDF;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;

class ProductController extends Controller
{
    public function index(){
        $categorys = Category::all();
        $units = Unit::all();
        $items = Item::all();
        return view('management.product.product')->with([
            'categorys' => $categorys,
            'units' => $units,
            'items' => $items
        ]);
    }

    // ------------ CATEGORY -------------
    public function category_store(Request $request){
        $this->validate($request,[
            'name' => 'required|not_regex:/[^a-zA-Z0-9\s]/'
        ]);
        try{
            Category::firstOrCreate(
                ['name' => $request->name], 
                ['name' => $request->name]
            );
            return back()->with('success','data category berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    public function category_destroy($id){
        try{
            Category::findOrfail($id)->delete();
            return back()->with('success', 'data category berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    // -------------- UNIT -----------------
    public function unit_store(Request $request){
        $this->validate($request,[
            'name' => 'required|not_regex:/[^a-zA-Z0-9\s]/'
        ]);
        try{
            Unit::firstOrCreate(
                ['name' => $request->name], 
                ['name' => $request->name]
            );
            return back()->with('success','data category berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function unit_destroy($id){
        try{
            Unit::findOrfail($id)->delete();
            return back()->with('success','data unit berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    // -------------- item -----------------
    public function item_create(){
        $categorys = Category::all();
        $units = Unit::all();
        $supplier = Supplier::all();
        return view('management.product.addItem')->with([
            'categorys' => $categorys,
            'units' => $units,
            'suppliers' => $supplier
        ]);
    }  
    public function item_store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'category' => 'required|exists:categorys,id',
            'unit' => 'required|exists:units,id',
            'price' => 'required|numeric|min:1',
            'methodStock' => 'required|in:fifo,lifo',
            'warning_expire' => 'required|numeric|min:1|nullable',
            'imageItem' => 'required|mimes:png,jpg,jpeg,jfif'
        ]);
        DB::beginTransaction();
        try{
            $image = $request->file('imageItem');
            $name_image = Str::random(5) . date('dmYhis');
            $extension = $image->getClientOriginalExtension();
            $item = Item::create([
                'name' => $request->name,
                'barcode' => '',
                'category_id' => $request->category,
                'unit_id' => $request->unit,
                'price' => $request->price,
                'method_stock' => $request->methodStock,
                'warning_expire' => $request->warning_expire,
                'image' => $name_image . '.' . $extension
            ]);
            $save_item_image = $image->storeAs('public/image_item',$name_image . '.' . $extension);
            $ean_13 = $this->export_ean13($item->id); // cuman bisa kalau panjang(baris)nya 9 tidak bisa lebih dari 9 karena 4 baris sudah di pakai dengan bilangan pertama 200 dan di bilangan terakhir
            $item->update([
                'barcode' => $ean_13
            ]);
            $this->barcode($ean_13);
            DB::commit();
            return redirect()->route('management.product.index')->with('success', 'data item berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            Storage::delete('public/image_item/' . $save_item_image);
            return back()->with('error', $e->getMessage() . $name_image);
        }
    }

    public function item_show($id){
        $item = Item::findOrfail($id);
        $categorys = Category::all();
        $suppliers = Supplier::all();
        $units = Unit::all();
        return view('management.product.editItem')->with([
            'categorys' => $categorys,
            'suppliers' => $suppliers,
            'units' => $units,
            'item' => $item
        ]);
    }

    public function item_edit(Request $request,$id){
        $this->validate($request,[
            'name' => 'required',
            'category' => 'required|exists:categorys,id',
            'unit' => 'required|exists:units,id',
            'price' => 'required|numeric|min:1',
            'methodStock' => 'required|in:fifo,lifo',
            'warning_expire' => 'required|numeric|min:1|nullable',
            'imageItem' => 'nullable|image|mimes:png,jpg,jpeg,jfif'
        ]);
        DB::beginTransaction();
        try{
            $item = Item::findOrfail($id);
            $item->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'unit_id' => $request->unit,
                'price' => $request->price,
                'method_stock' => $request->methodStock,
                'warning_expire' => $request->warning_expire,
            ]);
            // pengecekan apakah image di ubah atau tidak
            if(!empty($request->imageItem)){
                $image = $request->file('imageItem');
                $name_image = Str::random(5) . date('dmYhis');
                $extension = $image->getClientOriginalExtension();
                $image_before = $item->image;
                $item->update([
                    'image' => $name_image . '.' . $extension
                ]);
                Storage::delete('public/image_item/' . $image_before);
                $image->storeAs('public/image_item',$name_image . '.' . $extension);
            }
            DB::commit();
            return redirect()->route('management.product.index')->with('success','data item berhsail di update');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function item_destroy($id){
        DB::beginTransaction();
        try{
            $item = Item::findOrfail($id);
            $item->delete();
            Storage::delete('public/image_item/' . $item->image);
            Storage::delete('public/barcode/' . $item->barcode . '.pdf');
            DB::commit(); 
            return back()->with('success','data item berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function export_ean13($id){
        $code = '200' . str_pad($id, 9, '0');
        $weightflag = true;
        $sum = 0;
        // Weight for a digit in the checksum is 3, 1, 3.. starting from the last digit. 
        // loop backwards to make the loop length-agnostic. The same basic functionality 
        // will work for codes of different lengths.
        for ($i = strlen($code) - 1; $i >= 0; $i--)
        {
            $sum += (int)$code[$i] * ($weightflag?3:1);
            $weightflag = !$weightflag;
        }
        $code .= (10 - ($sum % 10)) % 10;
        return $code;
    }

    public function barcode($id){
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $barcode = $d->getBarcodeHTML(strval($id), 'EAN13');
        $pdf = PDF::loadView('barcode',['barcode' => $barcode,'id' => $id]);
        $code = Storage::put('public/barcode/' . $id . '.pdf',$pdf->output());
        return $code;
    }

    public function export_pdf()
    {
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $items = Item::all();
        $pdf =  Pdf::loadView('pdf.pdfProduct',['items' => $items,'d' => $d])->setPaper('a4', 'landscape');
        return $pdf->download('product.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    }

    public function export_all_barcode_pdf(){
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $items = Item::all();
        $pdf = Pdf::loadView('pdf.pdfAllBarcode',['items' => $items, 'd' => $d])->setPaper('a4','landscape');
        return $pdf->download('AllBarcode.pdf');
    }
}
