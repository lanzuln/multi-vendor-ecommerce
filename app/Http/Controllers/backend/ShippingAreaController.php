<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistricts;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller {
    public function AllDivision() {
        $division = ShipDivision::latest()->get();
        return view('backend.pages.ship-area.division.all', compact('division'));
    } // End Method

    public function AddDivision() {
        return view('backend.pages.ship-area.division.create');
    } // End Method

    public function StoreDivision(Request $request) {

        ShipDivision::insert([
            'division_name' => $request->division_name,
        ]);

        toastr()->success('ShipDivision Inserted Successfully');

        return redirect()->route('all.division');

    } // End Method
    public function EditDivision($id) {

        $division = ShipDivision::findOrFail($id);
        return view('backend.pages.ship-area.division.edit', compact('division'));

    } // End Method

    public function UpdateDivision(Request $request) {

        $division_id = $request->id;

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
        ]);

        toastr()->success('ShipDivision Updated Successfully');

        return redirect()->route('all.division');

    } // End Method

    public function DeleteDivision($id) {

        ShipDivision::findOrFail($id)->delete();

        toastr()->success('ShipDivision delete Successfully');
        return redirect()->back();

    } // End Method

    // ===================== districts setting
    public function AllDistrict() {
        $district = ShipDistricts::latest()->get();
        return view('backend.pages.ship-area.districts.all', compact('district'));
    } // End Method

    public function AddDistrict() {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.pages.ship-area.districts.create', compact('division'));
    } // End Method

    public function StoreDistrict(Request $request) {

        ShipDistricts::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        toastr()->success('ShipDistricts Inserted Successfully');

        return redirect()->route('all.district');

    } // End Method

    public function EditDistrict($id) {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::findOrFail($id);
        return view('backend.pages.ship-area.districts.edit', compact('district', 'division'));

    } // End Method

    public function UpdateDistrict(Request $request) {

        $district_id = $request->id;

        ShipDistricts::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        toastr()->success('ShipDistricts update Successfully');
        return redirect()->route('all.district');

    } // End Method

    public function DeleteDistrict($id) {

        ShipDistricts::findOrFail($id)->delete();

        toastr()->success('ShipDistricts delete Successfully');

        return redirect()->back();

    } // End Method

    // ============== state area

    public function AllState() {
        $state = ShipState::latest()->get();
        return view('backend.pages.ship-area.state.all', compact('state'));
    } // End Method

    public function AddState() {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        return view('backend.pages.ship-area.state.create', compact('division', 'district'));
    } // End Method

    public function GetDistrict($division_id) {
        $dist = ShipDistricts::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($dist);

    } // End Method

    public function StoreState(Request $request) {

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        toastr()->success('ShipState Inserted Successfully');

        return redirect()->route('all.state');

    }

    public function EditState($id) {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.pages.ship-area.state.edit', compact('division', 'district', 'state'));
    } // End Method

    public function UpdateState(Request $request) {

        $state_id = $request->id;

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);


        toastr()->success('ShipState Updated Successfully');


        return redirect()->route('all.state');

    } // End Method

    public function DeleteState($id) {

        ShipState::findOrFail($id)->delete();

        toastr()->success('ShipState delete Successfully');

        return redirect()->back();

    } // End Method

}
