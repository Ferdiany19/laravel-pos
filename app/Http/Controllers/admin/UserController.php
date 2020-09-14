<?php

namespace App\Http\Controllers\admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\models\UserProfile;
use App\models\RoleUser;
use App\User;
use DB;
use Exception;
use Illuminate\Http\Request;
use Storage;
use Str;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function export_pdf()
    {
        $users = User::all();
        $pdf = PDF::loadView('pdf.pdfUser',['users' => $users])->setPaper('a4','Landscape');
        return $pdf->download('user.pdf');
    }


    public function export_excel()
    {
        return Excel::download(new UserExport, 'user.xlsx');
    }

    public function index(){
        $users = User::all();
        return view('admin.user.index')->with([
            'users' => $users
        ]);
    }
    public function create(){
        $role_users = RoleUser::all();
        return view('admin.user.create')->with([
            'role_users' => $role_users
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'gender' => 'required|in:m,f',
            'phone_number' => 'required|digits_between:1,14',
            'email' => 'required|email',
            'password' => 'required',
            'role_user' => 'required|exists:role_users,id',
            'address' => 'required',
            'image' => 'required|image|mimes:png,jpg,jfif,jpeg'
        ]);

        DB::beginTransaction();
        try{
            $image = $request->file('image');
            $name_image = Str::random(5) . date('dmYhis');
            $extension = $image->getClientOriginalExtension();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_user_id' => $request->role_user
            ]);
            UserProfile::create([
                'user_id' => $user->id,
                'fullname' => $user->name,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'image' => $name_image . '.' . $extension
            ]);
            $image->storeAs('public/image_user',$name_image . '.' . $extension);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'data user berhasil di buat');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id){
        $user = User::findOrfail($id);
        $role_users = RoleUser::all();
        return view('admin.user.edit')->with([
            'user' => $user,
            'role_users' => $role_users
        ]);
    }

    public function edit(Request $request,$id){
        $this->validate($request,[
            'name' => 'required',
            'gender' => 'required|in:m,f',
            'phone_number' => 'required|digits_between:1,14',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_user' => 'required|exists:role_users,id',
            'address' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jfif,jpeg,'
        ]);
        DB::beginTransaction();
        try{
            $user = User::findOrfail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_user_id' => $request->role_user,
            ]);
            if(!empty($request->password)){
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
            $user->user_profiles()->update([
                'fullname' => $request->name,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]);
            if(!empty($request->image)){
                $image = $request->file('image');
                $name_image = Str::random(5) . date('dmYhis');
                $extension = $image->getClientOriginalExtension();
                $image_before = $user->user_profiles()->first()->image;
                $user->user_profiles()->update([
                    'image' => $name_image . '.' . $extension
                ]);
                Storage::delete('public/image_user/' . $image_before);
                $image->storeAs('public/image_user',$name_image . '.' . $extension);
            }
            DB::commit();
            return redirect()->route('admin.user.index')->with('success','data berhasil di perbarui');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            User::findOrfail($id)->delete();
            return back()->with('success','data berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }
}
