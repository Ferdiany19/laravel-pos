<?php

namespace App\Http\Controllers\admin;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('admin.customer.customer')->with([
            'customers' => $customers
        ]);
    }

    public function create(){
        return view('admin.customer.addCustomer');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:225|not_regex:/[^a-zA-Z\s]/',
            'phone' => 'required|digits_between:1,15|numeric',
            'gender' => 'required|in:m,f',
            'address' => 'required',
        ]);
        try{
            Customer::firstOrCreate(
                ['name' => $request->name], 
                [
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'phone_number' => $request->phone,
                    'address' => $request->address
                ]
            );
            return redirect()->route('admin.customer.index')->with('success','data customer berhasil di tambah');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function show_edit($id){
        $customer = Customer::findOrfail($id);
        return view('admin.customer.editCustomer')->with([
            'customer' => $customer
        ]);
    }

    public function edit(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:3|max:225|not_regex:/[^a-zA-Z\s]/|unique:customers,name,' . $id,
            'phone' => 'required|digits_between:1,15|numeric',
            'gender' => 'required|in:m,f',
            'address' => 'required',
        ]);
        try{
            Customer::findOrfail($id)->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'phone_number' => $request->phone,
                'address' => $request->address
            ]);
            return redirect()->route('admin.customer.index')->with('success','data customer berhasil di update');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id){
        try{
            Customer::findOrfail($id)->delete();
            return back()->with('success','data berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function export_pdf()
    {
        $customers = Customer::all();
        $pdf = PDF::loadview('pdf.pdfCustomer',['customers' => $customers]);
        return $pdf->download('customer.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new CustomerExport, 'customer.xlsx');
    }
}
