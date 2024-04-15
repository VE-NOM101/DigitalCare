<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineBrand;
use App\Models\MedicineCategory;
use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    //

    public function dashboard()
    {
        return view('control.pharmacist.dashboard');
    }
    public function medicines(){
        $data['getCategory'] = MedicineCategory::all();
        $data['getBrand'] = MedicineBrand::all();
        $data['getMedicine'] = Medicine::all();
        return view('control.pharmacist.medicines',$data);
    }
    public function add_medicine_category(){

        return view('control.pharmacist.add_medicine_category');
    }
    public function post_add_medicine_category(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        if (MedicineCategory::where('name', $request->name)->count() == 0) {

            $medicine_category = new MedicineCategory;
            $medicine_category->name = $request->name;
            $medicine_category->save();

            return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine category added successfully');
        } else {
            return redirect(url('_pharmacist/medicines'))->with('error', 'Medicine category already exists');
        }
    }
    public function edit_medicine_category($id){
        $data['getCategory'] = MedicineCategory::find($id);
        return view('control.pharmacist.edit_medicine_category',$data);
    }

    public function update_medicine_category($id,Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        if (MedicineCategory::where('name', $request->name)->where('id','<>',$id)->count() == 0) {

            $medicine_category = MedicineCategory::find($id);
            $medicine_category->name = $request->name;
            if($request->isActive =='1'){
                $medicine_category->isActive = 1;
            }else {
                $medicine_category->isActive = 0;
            }
            $medicine_category->save();

            return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine category updated successfully');
        } else {
            return redirect(url('_pharmacist/medicines'))->with('error', 'Medicine category already exists');
        }
    }

    public function delete_medicine_category($id){
        $medicine_category = MedicineCategory::find($id);
        $medicine_category->delete();
        return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine Category Deleted Successfully');
    }

    public function add_medicine_brand(){

        return view('control.pharmacist.add_medicine_brand');
    }
    public function post_add_medicine_brand(Request $request){
        $request->validate([
            'brand' => 'required'
        ]);
        if (MedicineBrand::where('brand', $request->brand)->count() == 0) {

            $medicine_brand = new MedicineBrand;
            $medicine_brand->brand = $request->brand;
            $medicine_brand->email = $request->email;
            $medicine_brand->phone = $request->phone;
            $medicine_brand->save();

            return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine brand added successfully');
        } else {
            return redirect(url('_pharmacist/medicines'))->with('error', 'Medicine brand already exists');
        }
    }

    public function edit_medicine_brand($id){
        $data['getBrand'] = MedicineBrand::find($id);
        return view('control.pharmacist.edit_medicine_brand',$data);
    }

    public function update_medicine_brand($id,Request $request){
        $request->validate([
            'brand' => 'required'
        ]);
        if (MedicineBrand::where('brand', $request->brand)->where('id','<>',$id)->count() == 0) {

            $medicine_brand = MedicineBrand::find($id);
            $medicine_brand->brand = $request->brand;
            $medicine_brand->email = $request->email;
            $medicine_brand->phone = $request->phone;
            $medicine_brand->save();

            return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine brand updated successfully');
        } else {
            return redirect(url('_pharmacist/medicines'))->with('error', 'Medicine brand already exists');
        }
    }
    public function delete_medicine_brand($id){
        $medicine_brand = MedicineBrand::find($id);
        $medicine_brand->delete();
        return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine Brand Deleted Successfully');
    }

    public function add_medicine(){
        $data['getCategory'] = MedicineCategory::where('isActive',1)->get();
        $data['getBrand'] = MedicineBrand::all();
        return view('control.pharmacist.add_medicine',$data);
    }

    public function post_add_medicine(Request $request){
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'salt_composition' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
        ]);
        if (Medicine::where('name', $request->name)->count() == 0) {

            $medicine = new Medicine;
            $medicine->name = $request->name;
            $medicine->category_id = $request->category_id;
            $medicine->brand_id = $request->brand_id;
            $medicine->salt_composition = $request->salt_composition;
            $medicine->buying_price = $request->buying_price;
            $medicine->selling_price = $request->selling_price;
            $medicine->side_effect = $request->side_effect;
            $medicine->description = $request->description;
            $medicine->save();

            return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine added successfully');
        } else {
            return redirect(url('_pharmacist/medicines'))->with('error', 'Medicine already exists');
        }
    }
}
