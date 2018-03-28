<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index']
        ]);
        $this->middleware('guest', [
            'only' => 'create'
        ]);
    }
    public function index(){
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
    //用户注册
    public function create(){
    	return view('users.create');
    }
    //展示用户信息
    public function show(User $user){
    	return view('users.show', compact('user'));
    }
    //用户注册提交
    public function store(Request $request){
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'email' => 'required|email|unique:users|max:255',
    		'password' => 'required|confirmed|min:6'
    	]);
    	//return;

    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);

        Auth::login('$user');
    	session()->flash('success', '欢迎来到laravel世界');
    	return redirect()->route('users.show', [$user]);
    }
    //用户修改个人信息
    public function edit(User $user){
        //echo '444';exit;
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
    //用户提交个人信息修改
    public function update(User $user, Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'required|confirmed|min:6',
        ]);

        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        if( $request->password ){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '个人资料修改成功！');
        // $user->update([
        //     'name' => $request->name,
        //     'password' => bcrypt($request->password)
        // ]);


        return redirect()->route('users.show', $user->id);
    }
    //删除用户操作
    public function destroy(User $user){
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户');
        return back();
    }




}
