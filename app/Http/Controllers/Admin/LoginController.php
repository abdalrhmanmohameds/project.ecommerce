<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LoginController extends Controller
{

    public function getLogin(){
        return view('admin.Auth.login');
    }


    public function login(LoginRequest $request){

        //MAKE VALIDATE

        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
//            notify()->success('تم الدخول بنجاح');
            return redirect()->route('admin.dashboard');
        }
//        notfiy()->error('خطا في البيانات برجاء المحاولة مجددا');
//        return redirect()->back()->withErrors($validatore)->withInput($request -> all());
        return redirect()->back()->with(['error' => 'يوجد هناك خطا في البيانات']);
    }
}
