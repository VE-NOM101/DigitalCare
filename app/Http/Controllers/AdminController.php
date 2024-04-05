<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //Users
    public function dashboard()
    {
        return view('control.admin.dashboard');
    }
    public function users(){
        $data['getRecord']  = User::get();
        return view('control.admin.users',$data);
    }
    public function edit_users($id){
        $data['getRecord']= User::find($id);
        return view('control.admin.edit_users',$data);
    }
    public function update_users($id,Request $request){
        $user = User::find($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->save();

        return redirect('/_admin/users')->with('success','User is successfully updated');
    }
    public function delete_users($id){
        $data= User::find($id);
        $data->delete();
        //using error tag for indicating deletion
        return redirect('/_admin/users')->with('error','User record deleted successfully');
    }

    //Roles

    public function roles(){
        $data['getRecord']  = User::get();
        return view('control.admin.roles',$data);
    }

    public function edit_roles($id,Request $request){
        $user = User::find($id);
        $user->role=$request->role;
        $user->save();

        return redirect('/_admin/roles')->with('success','User role updated successfully');

    }


}
