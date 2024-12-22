<?php

namespace App\Http\Controllers\hierarchy;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $regions = Region::when($request['search'], function ($q) use($request){
                $key = explode(' ', $request['search']);
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
                }
            })
            ->latest()->paginate()->appends($query_param);

        if(isset($search) && empty($search)) {
            $regions = Region::orderBy('created_at', 'asc')
            ->paginate(10);
        }

        
        $data = [
            'regions' => $regions,
            'search' => $search,
        ];

        return view('admin-views.region.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => 'required',
            "code" => 'required',
        ]);
        $region = Region::create($request->all());
        return redirect()->back()->with('success',__('region.added_successfully'));
    }
    public function edit($id){
        $region = Region::findOrFail($id);
        return view('admin-views.region.edit', compact('region'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name'=> 'required',
            "code" => 'required',
        ]);
        $region = Region::findOrFail($id);
        $region->update($request->all());
        return redirect()->route('region')->with('success',__('region.updated_successfully'));
    }
    public function delete(Request $request){
        $region = Region::findOrFail($request->id);
        $region->delete();
        return redirect()->back()->with('success',__('region.deleted_successfully'));
    }
}
