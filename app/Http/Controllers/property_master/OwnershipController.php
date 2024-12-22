<?php

namespace App\Http\Controllers\property_master;

use App\Models\Ownership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\OwnershipServices;
use Illuminate\Support\Facades\Log;

class OwnershipController extends Controller
{
    public $ownership_services;
    public $model;
    public function __construct(OwnershipServices $ownership_services){
        $this->ownership_services = $ownership_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            Ownership::whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $ownership = Ownership::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $ownership,
            'search'            => $search,
            'route'             => 'ownership',
            'description'       => 'no',
            'code_status'                   => 'yes',

        ];
        return view("admin-views.property_master.index" , $data);
    }
 
    public function store(Request $request){
        try{
            $ownership_services = $this->ownership_services->storePropertyMasterModal($request);
            return redirect()->route('ownership.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $ownership_services = $this->ownership_services->findOrFail($id);
        $data = [
            "main"                          => $ownership_services, 
            'route'                         => 'ownership',
            'description'                   => 'no',
            'code_status'                   => 'yes',

        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){

        try{
            // $request->id = $id;
            $ownership_services = $this->ownership_services->updatePropertyMasterModal($request);
            return redirect()->route('ownership.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $ownership_services = $this->ownership_services->findOrFail($request->id);
        // dd($ownership_services);

        $ownership_services_delete = $this->ownership_services->deletePropertyMasterModal($request->id);
        ($ownership_services_delete == true) ? redirect()->route("ownership.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }

}
