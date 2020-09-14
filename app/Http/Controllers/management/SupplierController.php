<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use App\models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\SupplierExport;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::all();
        return view('management.supplier.supplier')->with([
            'suppliers' => $suppliers
        ]);
    }


    public function create(){
        return view('management.supplier.addSupplier');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:225|not_regex:/[^a-zA-Z\s]/',
            'phone' => 'required|digits_between:1,15|numeric',
            'address' => 'required',
            'description' => 'required'
        ]);

        try{
            Supplier::firstOrCreate(
                ['name' => $request->name],
                [
                    'name' => $request->name,
                    'phone_number' => $request->phone,
                    'address' => $request->address,
                    'description' => $request->description
                ]
            );
            return redirect()->route('management.supplier.index')->with('success','data supplier berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage() );
        }
    }

    public function show_edit($id){
        $supplier = Supplier::findOrfail($id);
        return view('management.supplier.editSupplier')->with([
            'supplier' => $supplier
        ]);
    }

    public function edit(Request $request,$id){
        $this->validate($request,[
            'name' => ['required','min:3','max:225','not_regex:/[^a-zA-Z\s]/',Rule::unique('suppliers')->ignore($id,'id')],
            'phone' => 'required|digits_between:1,15|numeric',
            'address' => 'required',
            'description' => 'required'
        ]);

        try{
            Supplier::findOrfail($id)->update([
                'name' => $request->name,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'description' => $request->description
            ]);
            return redirect()->route('management.supplier.index')->with('success','data berhasil di update');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function destroy($id){
        try{
            Supplier::findOrfail($id)->delete();
            return redirect()->route('management.supplier.index')->with('success','data berhasil di hapus');
        }catch(Exception $e){ 
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function cetak_pdf(){
        $suppliers = Supplier::all();
        $pdf = PDF::loadview('pdf.pdfSupplier',['suppliers' => $suppliers]);
        return $pdf->download('supplier.pdf');
    }

    public function cetak_excel()
    {
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }
}
