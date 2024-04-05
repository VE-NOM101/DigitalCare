<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
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

    //blocks

    public function blocks(){
        $data['getRecord']  = Block::get();
        return view('control.admin.blocks',$data);
    }
    public function add_blocks(Request $request){
        $blocks = new Block;
        $blocks->blockName = $request->input('blockName');
        $blocks->blockCode = $request->input('blockCode');
        $blocks->save();
        return redirect('/_admin/add_blocks')->with('success','Block inserted successfully');
    }

    public function edit_blocks($id){
        $blocks['getRecord'] = Block::find($id);

        return view('control.admin.edit_blocks',$blocks);

    }
    public function update_blocks($id, Request $request){
        $blocks= Block::find($id);
        $blocks->blockName =  $request->blockName;
        $blocks->blockCode = $request->blockCode;
        $blocks->save();
        return redirect('/_admin/blocks')->with('success','Block updated successfully');

    }
    public function delete_blocks($id){
        $blocks = Block::find($id);
        $blocks->delete();
        return redirect('/_admin/blocks')->with('error','Block deleted successfully');
    }

    //departments
    public function departments(){
        $departments['getRecord']=Department::get();
        return view('control.admin.departments',$departments);
    }
    public function show_departments(){
        $blocks['getBlock'] =Block::get();
        return view('control.admin.add_departments',$blocks);
    }

    public function add_departments(Request $request){
        $request->validate([
            'name'=>'required',
            'photo_path'=> 'required|mimes:png,jpg,jpeg,bmp',
            'description'=> 'required',
        ]);

        $imageName = '';
        if($image =$request->file('photo_path')){
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //into public folder
            $image->move('digitalcare/admin/departments',$imageName);
        }

        $department = new Department;
        $department->name = $request->input('name');
        $department->photo_path =$imageName;
        $department->description =$request->input('description');
        $department->block_id =$request->input('block_id');
        $department->save();
        return redirect('/_admin/show_departments')->with('success','Department added successfully');
    }

    public function edit_departments($id){
        $departments['getRecord']=Department::find($id);
        $departments['getBlock'] =Block::get();
        return view('control.admin.edit_departments',$departments);
    }

    public function update_departments($id, Request $request){
        
        $department = Department::find($id);
        
        $request->validate([
            'name'=>'required',
            'description'=> 'required',
        ]);

        $imageName = '';
        $deleteOldImage = 'digitalcare/admin/departments/'.$department->photo_path;

        if($image =$request->file('photo_path')){
            if(file_exists($deleteOldImage)){
                File::delete($deleteOldImage);
            }
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //into public folder
            $image->move('digitalcare/admin/departments',$imageName);
        }else{
            $imageName = $department->photo_path;
        }

        $department->name = $request->input('name');
        $department->photo_path =$imageName;
        $department->description =$request->input('description');
        $department->block_id =$request->input('block_id');
        $department->save();
        return redirect('/_admin/departments')->with('success','Department Updated successfully');
    }
}
