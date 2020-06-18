<?php

namespace App\Http\Controllers;

use App\Friend;
use App\MyList;
use Illuminate\Http\Request;
use App\User;
use App\Home;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MyController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginCheck(Request $request){
        $name = $request->get('name');
        $password = $request->get('password');
        $email = $request->get('email');
        $users = User::all();
        $flag = false;
        foreach ($users as $user){
            if ($user->name == $name && $user->password == $password && $user-> email ==$email){
                $flag = true;
            }
        }
        if ($flag){
            Session::put('name',$name);
            return redirect("/loginSuccess");
        }else{
            print ("登录失败,请");
            print ("<a href='login'>重新登录</a>！");
        }
    }

    //用户主页
    public function loginSuccess(){
        $name = Session::get('name');
        $data = DB::table('home')->where('name',$name)->orWhere('share','like','%'.$name.'%')->paginate(100);
        return view('home',compact('data'));
    }

    public function register(){
        return view('register');
    }

    public function add(Request $request){
        $var = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
        if ($var){
            return redirect('/login');
        }else{
            dump("aaa");
        }
    }

    public function insert(){
        return view('insert');
    }

    public function insert_home(Request $request){
        $name = Session::get('name');
        $work = $request->get('work');
        $status = $request->get('status');
        $share = $request->get('share');
        $result = Home::create(['name'=>$name,'work' => $work, 'status' => $status, 'share' => $share.' ']);
        if ($result){
            //添加成功
            return redirect("/loginSuccess");
        }else{
            //添加失败
            print ("添加失败,请");
            print ("<a href='insert'>重新添加</a>！");
        }
    }

    public function out(){
        return redirect('login');
    }

    public function update_home(Request $request){
        $id = $request->get('id');
        Session::put('id',$id);
        $data = Home::find($id);
        return view('update_home',compact('data'));
    }

    public function update_home_op(Request $request){
        $id = Session::get('id');
        $work = $request->get('work');
        $status = $request->get('status');
        $share = $request->get('share');
        Home::where('id', $id) -> update(['work' => $work, 'status' => $status, 'share' => $share.' ']);
        return redirect("/loginSuccess");
    }

    public function delete_home(Request $request){
        $id = $request->get('id');
        $result = Home::where('id', $id)->delete();
        if ($result){
            return redirect("/loginSuccess");
        }else{
            print ("删除失败,请");
            print ("<a href='loginSuccess'>重新删除</a>！");
        }
    }

    public function accept_home(Request $request){
        $name = Session::get('name');
        $id = $request->get('id');

        $var = Home::find($id);
        $share = $var->share;

        if (strpos($share,$name.'已接受 ') !== false){

        }elseif (strpos($share,$name.'未接受 ') !== false){
            $str = str_replace($name.'未接受 ', $name.'已接受 ', $share);
            Home::where('id',$id) -> update(['status'=>'进行中','share'=>$str]);
        }else{
            $str = str_replace($name, $name.'已接受 ', $share);
            Home::where('id',$id) -> update(['status'=>'进行中','share'=>$str]);
        }
        return redirect("/loginSuccess");
    }

    public function un_accept_home(Request $request){
        $name = Session::get('name');
        $id = $request->get('id');

        $var = Home::find($id);
        $share = $var->share;

        if (strpos($share,$name.'未接受 ') !== false){

        }elseif (strpos($share,$name.'已接受 ') !== false){
            $str = str_replace($name.'已接受 ', $name.'未接受 ', $share);
            Home::where('id',$id) -> update(['status'=>'待接受','share'=>$str]);
        }else{
            $str = str_replace($name, $name.'未接受 ', $share);
            Home::where('id',$id) -> update(['status'=>'待接受','share'=>$str]);
        }
        return redirect("/loginSuccess");
    }

    public function todo(Request $request){
        $id = $request->get('id');
        Session::put('id',$id);
        return redirect('todo_all');
    }

    public function todo_all(Request $request){
        $id = Session::get('id');
        $name = Session::get('name');
        if (Session::has('进行中')){
            $data = DB::table('myList')->where('home_id',$id)->where('status','进行中')->paginate(100);
            Session::forget('进行中');
        }elseif (Session::has('已完成')){
            $data = DB::table('myList')->where('home_id',$id)->where('status','已完成')->paginate(100);
            Session::forget('已完成');
        }else{
            $data = DB::table('myList')->where('home_id',$id)->paginate(100);
        }
        $friend = DB::table('friend')->where('name', $name)->get();

        $s_name = $request->get('name');
        $s_email = $request->get('email');
        if ($s_name || $s_email){
            Session::put('s_name',$s_name);
            Session::put('s_email',$s_email);
            if (!$s_email){
                $s_email = '无名氏';
            }
            if (!$s_name){
                $s_name = '123@qq.com';
            }
            $user = DB::table('user')->where('name', 'like', '%' . $s_name . '%')->orwhere('email', 'like', '%' . $s_email . '%')->get();
            return view('todo',compact('data','friend','user'));
        }else {
            $user = false;
            return view('todo', compact('data', 'friend','user'));
        }
    }

    public function add_list(){
        return view('add_list');
    }

    public function add_list_op(Request $request){
        $id = Session::get('id');
        $item = $request->get('item');
        $status = $request->get('status');
        $result = MyList::create(['item' => $item, 'status' => $status, 'home_id' => $id]);
        if ($result){
            return redirect('todo_all');
        }else{
            print ("添加失败,请");
            print ("<a href='add_list'>重新添加</a>！");
        }
    }

    public function list_all(){
        return redirect('todo_all');
    }

    public function list_do(){
        Session::put('进行中','进行中');
        return redirect('list_all');
    }

    public function list_end(){
        Session::put('已完成','已完成');
        return redirect('list_all');
    }

    public function del_list_end(){
        MyList::where('status','已完成')->delete();
        return redirect('list_all');
    }

    public function update_list(Request $request){
        $id = $request->get('id');
        $data = MyList::find($id);
        return view('update_list',compact('data'));
    }

    public function update_list_op(Request $request){
        $id = $request->get('id');
        $item = $request->get('item');
        $status = $request->get('status');
        MyList::where('id',$id)->update(['item'=>$item,'status'=>$status]);
        return redirect('todo_all');
    }

    public function delSelect(Request $request){
        $id = $request->input('uid');
        MyList::where('id',$id)->delete();
        return redirect('list_all');
    }

    public function add_friend(Request $request){
        $name = Session::get('name');
        $friend = $request->get('friend');
        Friend::create(['name'=>$name,'friend'=>$friend]);
        return redirect('todo_all');
    }

    public function delete_friend(Request $request){
        $id = $request->get('id');
        Friend::where('id',$id)->delete();
        return redirect('list_all');
    }
}
