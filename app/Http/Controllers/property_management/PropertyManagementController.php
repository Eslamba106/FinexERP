<?php

namespace App\Http\Controllers\property_management;

use App\Models\Ownership;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\CountryMaster;
use App\Models\PropertyManagement;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyManagementRequest;

class PropertyManagementController extends Controller
{
 
    public function index(Request $request){
        // $this->authorize('complaints');
        $ids = $request->bulk_ids;
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $property = PropertyManagement::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $property,
            'search'            => $search,


        ];
        return view("admin-views.property_management.property.index" , $data);
    }
    public function create(){

        $country_master = CountryMaster::all();
        $property_type = PropertyType::all();
        $owner_ship = Ownership::all();
        // dd($country_master);
        $data = [
            "property_type"             => $property_type,
            "owner_ship"                => $owner_ship,
            "country_master"            => $country_master,
        ];
        return view("admin-views.property_management.property.create" , $data);

    }

    public function store(PropertyManagementRequest $request){
        PropertyManagement::create($request->all());
        return redirect()->route("property_management.index")->with("success",__('property_master.added_successfully'));
    }

    public function show($id){
        $property = PropertyManagement::findOrFail($id);
        $data = [
            'property'=> $property
        ];
        return view('admin-views.property_management.property.show', $data);
    }

    public function view_image($id){
        $property = PropertyManagement::findOrFail($id);
        $data = [
            'property'=> $property
        ];
        return view('admin-views.property_management.property.view_image', $data);
    }
}
