<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','user')->latest()->get();
        return view('admin.users.users',compact('users' ));
    }

    public function show($id){

        $user = User::find($id);
        return view('admin.users.user',compact('user' ));

    }

    public function changeStatus($id){
        $user = User::find($id);

        if($user->status==1){
            $user->status=0;
            $user->save();
            $message = trans('dash.Inactive Successfully');
        }else{
            $user->status=1;
            $user->save();
            $message= trans('dash.Active Successfully');
        }
        return response()->json($message);
    }
}
