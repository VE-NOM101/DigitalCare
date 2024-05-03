<?php

namespace App\Http\Controllers;

use App\Models\BookAmbulance;
use App\Models\Campaign;
use App\Models\CampaignMessage;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    //

    //index function

    public function index()
    {
        $data['getDepartment'] = Department::get();
        $data['getDoctor'] = Doctor::get();
        $data['getCampaign'] = Campaign::where('isActive', 1)->get();
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            if ($user->notification == 0) {
                $user->notification = 1;
                $user->save();
                return redirect()->route('index')->with('info', CampaignMessage::find(1)->message)->with($data)->with('form_link', CampaignMessage::find(1)->form_link);
            }
        }
        return view('index', $data);
    }

    public function location()
    {
        return view('location');
    }

    public function book_ambulance()
    {
        return view('book_ambulance');
    }

    public function post_book_ambulance(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $position = new PositionController();
        $book_ambulance = new BookAmbulance();

        if ($request->city == '') {
            $var = $position->getCurrentCoordinates();
            $var = $var->getContent();
            $coordinates = json_decode($var); // Decode the JSON response
            $book_ambulance->name = $request->name;
            $book_ambulance->phone = $request->phone;
            $book_ambulance->lon = $coordinates->lon;
            $book_ambulance->lat = $coordinates->lat;
            $book_ambulance->city = $coordinates->city;
            $book_ambulance->save();
        } else {
            $var = $position->getCoordinatesByCity($request->city);
            $var = $var->getContent();
            $coordinates = json_decode($var); // Decode the JSON response
            if ($coordinates->status == 'error') {
                return redirect('/book_ambulance')->with('error', $coordinates->message);
            }
            $book_ambulance->name = $request->name;
            $book_ambulance->phone = $request->phone;
            $book_ambulance->lon = $coordinates->lon;
            $book_ambulance->lat = $coordinates->lat;
            $book_ambulance->city = $coordinates->city;
            $book_ambulance->save();
        }

        return redirect('/book_ambulance')->with('success', 'Ambulance will arrive soon');
    }
}
