<?php

namespace App\Http\Controllers\hierarchy;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\CountryMaster;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $country_master = CountryMaster::when($request['search'], function ($q) use($request){
                $key = explode(' ', $request['search']);
                foreach ($key as $value) {
                    $q->Where('currency_name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
                }
            })
            ->latest()->paginate()->appends($query_param);

        if(isset($search) && empty($search)) {
            $country_master = CountryMaster::orderBy('created_at', 'asc')
            ->paginate(10);
        }
        $countries = Country::get();
        $regions = Region::get();

        
        $data = [
            'country_master' => $country_master,
            'countries' => $countries,
            'regions' => $regions,
            'search' => $search,
        ];

        return view('admin-views.country.index', $data);
    }

    public function store(Request $request)
    {
 
        $request->validate([
            'region_id'             => 'required',
        ]);
        
        $country = CountryMaster::create($request->all());
        return redirect()->back()->with('success',__('country.added_successfully'));
    }
    public function edit($id){
        $country = CountryMaster::findOrFail($id);
        $countries = Country::get();
        $regions = Region::get();

        return view('admin-views.country.edit', compact('country' , 'countries' ,'regions'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'region_id'=> 'required',
        ]);
        $country = CountryMaster::findOrFail($id);
        $country->update($request->all());
        return redirect()->route('country')->with('success',__('country.updated_successfully'));
    }
    public function delete(Request $request){
        $country = CountryMaster::findOrFail($request->id);
        $country->delete();
        return redirect()->back()->with('success',__('country.deleted_successfully'));
    }


    public function get_country($id){
        $country = Country::where('id' ,$id)->first();
        return json_encode($country);
    }
}
