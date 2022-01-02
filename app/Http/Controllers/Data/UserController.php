<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy()
    {
        $input = request()->all();
        $delete = User::where('id', request('id'))->delete();
        return response()->json($input);
    }
}
