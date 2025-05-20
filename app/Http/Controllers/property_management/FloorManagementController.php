<?php

namespace App\Http\Controllers\property_management;

use App\Models\Floor;
use Illuminate\Http\Request;
use App\Models\BlockManagement;
use App\Models\FloorManagement;
use App\Models\PropertyManagement;
use App\Http\Controllers\Controller;

class FloorManagementController extends Controller
{
    public function index(Request $request){
        // $this->authorize('floor_management');
        $ids = $request->bulk_ids;
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $floor_management = FloorManagement::join('floors' , 'floor_management.floor_id', '=', 'floors.id')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('floors.name', 'like', "%{$value}%")
                    ->orWhere('floor_management.id', $value);
            }
        })
        ->select('floor_management.*', 'floors.name as block_name')
        ->latest()->paginate()->appends($query_param);

        $data = [
            'floor_management'              => $floor_management,
            'search'            => $search,


        ];
        return view("admin-views.property_management.floor_management.floor_management_list" , $data);
    }
    public function create(){
        $property = PropertyManagement::get();
        $blocks = BlockManagement::get();
        $floors = Floor::get();
        $data = [
            "property"=> $property,
            "floors"=> $floors,
            "blocks"=> $blocks
        ] ;

        return view("admin-views.property_management.floor_management.create")->with($data);
        
    }
    public function store(Request $request){
        foreach($request->floors as $floor){
        $property = FloorManagement::create([
            "floor_id"                             => $floor,
            "property_management_id"            => $request->property,
            "block_management_id"               => $request->block,
        ]);
        }
        return redirect()->route("floor_management.index")->with("success",__('property_master.added_successfullyp'));
    }

    public function get_blocks_by_property_id($id){
        $property = PropertyManagement::findOrFail($id);
        $blocks = BlockManagement::where('property_management_id' , $property->id)->with('block')->get();
        return json_encode($blocks);
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_subscription');
        $subscription = FloorManagement::findOrFail($request->id);
        $subscription->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
    }
}
