<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;


class SessionsController extends Controller
{
    public function create(){
        if( Auth::user() ){
            return redirect()->route('users.show', [Auth::user()]);
        }else{
            return view('sessions.create');    
        }    	
    }
    public function store( Request $request ){
    	$credentials = $this->validate($request, [
    		'email' => 'required|email|max:255',
    		'password' => 'required'
    	]);

    	if(Auth::attempt($credentials, $request->has('remember'))){
    		session()->flash('success', '欢迎回来！');
    		return redirect()->route('users.show', [Auth::user()]);
    	}else{
    		session()->flash('danger', "很抱歉，你输入的邮箱和密码不匹配");
    		return redirect()->back();
    	}
    	return;
    }
    public function destory(){
        Auth::logout();
        session()->flash('success', '您已经成功退出！');
        return redirect('login');
    }    
}
