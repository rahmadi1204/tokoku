<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Setting\AppData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Setting\LogActivity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AppController extends Controller
{
    public function index()
    {
        $title = "Setting";
        $data = AppData::first();
        $logs = LogActivity::all();
        return view('page.setting', compact(['title', 'data', 'logs']));
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
            $name =  AppData::where('id', 1)->value('name');
            if ($name != $request->app_name) {
                AppData::where('id', 1)->update([
                    'name' => $request->app_name,
                ]);
                $activity = "update app name";
                $log = new AppController;
                $log->logActivity($activity);
            }
            $cek = Hash::check($request->old_password, auth()->user()->password);
            if ($cek) {
                User::where('id', auth()->user()->id)->update([
                    'password' => bcrypt($request->password),
                ]);
                $activity = "update password";
                $log = new AppController;
                $log->logActivity($activity);
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
        try {
            $imageName = 'logo.' . $request->app_logo->extension();
            Storage::putFileAs('images/app', $request->file('app_logo'),  $imageName);
            AppData::where('id', 1)->update([
                'logo' => $imageName,
            ]);
            $activity = "update app logo";
            $log = new AppController;
            $log->logActivity($activity);
            DB::commit();
            return redirect()->back()->with('success', 'Logo Berhasil Diupload');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal');
        }
    }
    public function logActivity($activity)
    {
        LogActivity::insert([
            'user' => auth()->user()->name,
            'activity' => $activity,
            'date' => now(),
        ]);
    }
}
