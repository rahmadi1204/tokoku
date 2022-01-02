<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Setting\AppData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    public function index()
    {
        $title = "Setting";
        $data = AppData::first();
        $access = User::with('roles')->get();
        // dd($access);
        return view('page.setting', compact(['title', 'data', 'access']));
    }
    public function appName()
    {
        if (request()->ajax()) {
            $appName = AppData::first();
            return response()->json($appName);
        }
    }
    public function appLogo()
    {
        $appLogo = AppData::value('logo');
        return $appLogo;
    }
    public function cekPassword()
    {
        $cek = Hash::check(request()->old_password, auth()->user()->password);
        return response()->json($cek);
    }
    public function appStore(Request $request)
    {
        DB::beginTransaction();
        try {
            AppData::where('id', 1)->update([
                'name' => $request->app_name,
            ]);
            $cek = Hash::check($request->old_password, auth()->user()->password);
            if ($cek) {
                User::where('id', auth()->user()->id)->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            DB::commit();
            if ($cek) {
                return redirect()->back()->with('success', 'Data Disimpan, Password Diubah');
            } else {
                return redirect()->back()->with('success', 'Data Disimpan, Password Tidak Diubah');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal');
        }
    }
    public function logoStore(request $request)
    {
        $request->validate([
            'app_logo' => 'required|mimes:png,jpg,jpeg,svg',
        ]);
        DB::beginTransaction();
        // try {
        $imageName = 'logo.' . $request->app_logo->extension();
        Storage::putFileAs('images/app', $request->file('app_logo'),  $imageName);
        AppData::where('id', 1)->update([
            'logo' => $imageName,
        ]);
        DB::commit();
        return redirect()->back()->with('success', 'Logo Berhasil Diupload');
        // } catch (\Throwable $th) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal');
        // }
    }
}
