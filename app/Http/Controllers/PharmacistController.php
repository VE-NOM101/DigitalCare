<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineBrand;
use App\Models\MedicineCategory;
use App\Models\MedicinePurchase;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacistController extends Controller
{
    //

    public function dashboard()
    {
        return view('control.pharmacist.dashboard');
    }
    public function medicines()
    {
        $data['getCategory'] = MedicineCategory::all();
        $data['getBrand'] = MedicineBrand::all();
        $data['getMedicine'] = Medicine::all();
        $data['getMedicinePurchase'] = MedicinePurchase::where('pharmacist_id',Pharmacist::where('user_id',Auth::user()->id)->first()->id)->get();
        return view('control.pharmacist.medicines', $data);
    }
    public function add_medicine_category()
    {

        return view('control.pharmacist.add_medicine_category');
    }
    public function post_add_medicine_category(Request $request)
    {
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
    public function edit_medicine_category($id)
    {
        $data['getCategory'] = MedicineCategory::find($id);
        return view('control.pharmacist.edit_medicine_category', $data);
    }

    public function update_medicine_category($id, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        if (MedicineCategory::where('name', $request->name)->where('id', '<>', $id)->count() == 0) {

            $medicine_category = MedicineCategory::find($id);
            $medicine_category->name = $request->name;
            if ($request->isActive == '1') {
                $medicine_category->isActive = 1;
            } else {
                $medicine_category->isActive = 0;
            }
            $medicine_category->save();

            return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine category updated successfully');
        } else {
            return redirect(url('_pharmacist/medicines'))->with('error', 'Medicine category already exists');
        }
    }

    public function delete_medicine_category($id)
    {
        $medicine_category = MedicineCategory::find($id);
        $medicine_category->delete();
        return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine Category Deleted Successfully');
    }

    public function add_medicine_brand()
    {

        return view('control.pharmacist.add_medicine_brand');
    }
    public function post_add_medicine_brand(Request $request)
    {
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

    public function edit_medicine_brand($id)
    {
        $data['getBrand'] = MedicineBrand::find($id);
        return view('control.pharmacist.edit_medicine_brand', $data);
    }

    public function update_medicine_brand($id, Request $request)
    {
        $request->validate([
            'brand' => 'required'
        ]);
        if (MedicineBrand::where('brand', $request->brand)->where('id', '<>', $id)->count() == 0) {

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
    public function delete_medicine_brand($id)
    {
        $medicine_brand = MedicineBrand::find($id);
        $medicine_brand->delete();
        return redirect(url('_pharmacist/medicines'))->with('success', 'Medicine Brand Deleted Successfully');
    }

    public function add_medicine()
    {
        $data['getCategory'] = MedicineCategory::where('isActive', 1)->get();
        $data['getBrand'] = MedicineBrand::all();
        return view('control.pharmacist.add_medicine', $data);
    }

    public function post_add_medicine(Request $request)
    {
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

    public function profile()
    {
        $user_id = Auth::user()->id;
        if (Pharmacist::where('user_id', $user_id)->count() > 0) {
            $details['getDetails'] = Pharmacist::where('user_id', $user_id)->first();
            return view('control.pharmacist.profile', $details);
        } else {
            return redirect('/_pharmacist/dashboard')->with('error', 'Your profile yet not accepted by the admin.');
        }
    }
    public function edit_profile($id, Request $request)
    {
        //Always remember where returns an array;
        $pharmacist = Pharmacist::find($id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'qualification' => 'required',
        ]);

        $pharmacist->name = $request->input('name');
        $pharmacist->qualification = $request->input('qualification');
        $pharmacist->address = $request->input('address');
        $pharmacist->save();
        return redirect('/_pharmacist/profile')->with('success', 'Profile Updated successfully');
    }

    public function buy_medicine()
    {
        $data['getMedicine'] = Medicine::all();
        return view('control.pharmacist.buy_medicine', $data);
    }

    public function getMedicinePrices($id)
    {
        $medicine = Medicine::findOrFail($id);

        return response()->json([
            'buying_price' => $medicine->buying_price,
            'selling_price' => $medicine->selling_price,
        ]);
    }

    public function post_buy_medicine(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'medicine_id.*' => 'required|exists:medicines,id',
            'lot_no.*' => 'required', // Validation rule for lot_no
            'quantity.*' => 'required|numeric|min:1', // Validation rule for quantity
            'notes' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0',
            'net' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,cheque,credit_card,online',
        ]);
        
        
        try {
            // Create a new MedicinePurchase instance
            $medicinePurchase = new MedicinePurchase();
            $medicinePurchase->pharmacist_id = Pharmacist::where('user_id', Auth::user()->id)->first()->id; // Assuming you're storing the current pharmacist's ID
            $medicinePurchase->note = $request->input('notes');
            $medicinePurchase->discount = $request->input('discount');
            $medicinePurchase->net = $request->input('net');
            $medicinePurchase->payment_method = $request->input('payment_method');
            $medicinePurchase->save();
            
            foreach ($request->input('medicine_id') as $key => $medicineId) {
                $medicinePurchase->medicines()->attach($medicineId, [
                    'lot_no' => $request->input('lot_no')[$key],
                    'quantity' => $request->input('quantity')[$key],
                    'tax' => $request->input('tax')[$key],
                    'amount' => $request->input('amount')[$key],
                    // Add any other pivot table columns here if needed
                ]);
            }


            

            //Medicine

            foreach ($request->input('medicine_id') as $key => $medicineId) {
                $medicine = Medicine::findOrFail($medicineId);
                $medicine->increment('quantity', $request->input('quantity')[$key]);
            }

            // Redirect with success message
            return redirect()->back()->with('success', 'Purchase completed successfully!');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to complete purchase. Please try again.');
        }
    }


    public function view_medicine_purchase($id){
        $getMedicinePurchase= MedicinePurchase::find($id);
        $data['getMedicinePurchase'] = $getMedicinePurchase;
        $data['getAllMedicine'] = $getMedicinePurchase->medicines()->get();
        return view('control.pharmacist.view_medicine_purchase',$data);
    }
}
