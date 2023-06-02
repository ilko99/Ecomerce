<?php

namespace App\Http\Controllers\Backend;

use App\Models\ShipState;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingAreaController extends Controller
{
    ///// Division CRUD functions

    public function AllDivision(){
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.division_all', compact('division'));
    }

    public function AddDivision(){
        return view('backend.ship.division.division_add');
    }

    public function StoreDivision(Request $request){
        ShipDivision::insert([
            'division_name' => $request->division_name 
        ]);

        $notification = array(
            'message' => 'Division Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }

    public function EditDivision($id){
        $division = ShipDivision::findOrFail($id);

        return view('backend.ship.division.division_edit', compact('division'));
    }

    public function UpdateDivision(Request $request){
        $division_id = $request->id;

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name
        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }

    public function DeleteDivision($id){
        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);
    }

    


    ///// District CRUD Functions

    public function AllDistrict(){
        $district = ShipDistrict::latest()->get();
        return view('backend.ship.district.district_all', compact('district'));
    }

    public function AddDistrict(){
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.district.district_add', compact('division'));
    }

    public function StoreDistrict(Request $request){
        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'disctrict_name' => $request->district_name 
        ]);

        $notification = array(
            'message' => 'District Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);
    }

    public function EditDistrict($id){
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);

        return view('backend.ship.district.district_edit', compact('district', 'division'));
    }

    public function UpdateDistrict(Request $request){
        $district_id = $request->id;

        ShipDistrict::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'disctrict_name' => $request->district_name
        ]);
        
        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);
    }

    public function DeleteDistrict($id){
        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);
    }



    ///// State CRUD function

    public function AllState(){
        $state = ShipState::latest()->get();
        return view('backend.ship.state.state_all', compact('state'));
    }

    public function AddState(){
        $district = ShipDistrict::orderBy('disctrict_name', 'ASC')->get();
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.state.state_add', compact('division', 'district'));
    }

    public function GetDistrict($division_id){
        $dist = ShipDistrict::where('division_id',$division_id)->orderBy('disctrict_name','ASC')->get();
        return json_encode($dist);
    }

    public function StoreState(Request $request){
        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name
        ]);

        $notification = array(
            'message' => 'State Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }

    public function EditState($id){
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::orderBy('disctrict_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);

        return view('backend.ship.state.state_edit', compact('district', 'division', 'state'));
    } 

    public function UpdateState(Request $request){
        $state_id = $request->id;

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name
        ]);
        
        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }

    public function DeleteState($id){
        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    }
}
