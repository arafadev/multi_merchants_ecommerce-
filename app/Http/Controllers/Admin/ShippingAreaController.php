<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShipState;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Models\ShipDistricts;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ship\StateStoreRequest;
use App\Http\Requests\Admin\Ship\StateUpdateRequest;

class ShippingAreaController extends Controller
{
    public function divisions()
    {
        $divisions = ShipDivision::latest()->get();
        return view('admin.ship.divisions.index', ['divisions' => $divisions]);
    }

    public function AddDivision()
    {
        return view('admin.ship.divisions.create');
    }

    public function StoreDivision(Request $request)
    {

        $validatedData = $request->validate([
            'division_name' => 'required|max:255',
        ]);

        ShipDivision::insert($validatedData);

        $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('divisions')->with($notification);
    }

    public function editDivision($id)
    {

        $division = ShipDivision::findOrFail($id);
        return view('admin.ship.divisions.edit', compact('division'));
    } // End Method

    public function updateDivision(Request $request, $id)
    {
        $validatedData = $request->validate([
            'division_name' => 'required|max:255',
        ]);

        ShipDivision::findOrFail($id)->update($validatedData);

        $notification = array(
            'message' => 'ShipDivision Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('divisions')->with($notification);
    } // End Method

    public function deleteDivision($id)
    {
        $division = ShipDivision::findOrFail($id);
        if ($division) {
            $division->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    /////////////// District CRUD ///////////////


    public function districts()
    {
        $districts = ShipDistricts::latest()->get();
        return view('admin.ship.districts.index', compact('districts'));
    } // End Method


    public function addDistrict()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('admin.ship.districts.create', compact('divisions'));
    } // End Method


    public function storeDistrict(Request $request)
    {

        $validatedData = $request->validate([
            'district_name' => 'required|max:255',
            'division_id' => 'required|exists:ship_divisions,id',
        ]);

        ShipDistricts::insert($validatedData);

        $notification = array(
            'message' => 'ShipDistricts Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('districts')->with($notification);
    } // End Method




    public function editDistrict($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::findOrFail($id);
        return view('admin.ship.districts.edit', compact('district', 'divisions'));
    } // End Method

    public function updateDistrict(Request $request, $id)
    {

        $validatedData = $request->validate([
            'district_name' => 'required|max:255',
            'division_id' => 'required|exists:ship_divisions,id',
        ]);
        ShipDistricts::findOrFail($id)->update($validatedData);
        $notification = array(
            'message' => 'ShipDistricts Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('districts')->with($notification);
    } // End Method


    public function deleteDistrict($id)
    {
        $district = ShipDistricts::findOrFail($id);
        if ($district) {
            $district->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    // State Crud
    public function states()
    {
        $state = ShipState::latest()->get();
        return view('admin.ship.states.index', ['state' => $state]);
    }

    public function addState()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        return view('admin.ship.states.create', compact('division', 'district'));
    }

    public function getDistrict($division_id)
    {
        $dist = ShipDistricts::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($dist);
    }

    public function storeState(StateStoreRequest $request)
    {
        ShipState::insert($request->validated());

        $notification = array(
            'message' => 'ShipDistricts Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('states')->with($notification);
    }

    public function editState($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('admin.ship.states.edit', compact('division', 'district', 'state'));
    } // End Method



    public function updateState(StateUpdateRequest $request, $id)
    {

        ShipState::findOrFail($id)->update($request->validated());
        $notification = array(
            'message' => 'Ship State Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('states')->with($notification);
    }
    public function deleteState($id)
    {
        $state = ShipState::findOrFail($id);
        if ($state) {
            $state->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
