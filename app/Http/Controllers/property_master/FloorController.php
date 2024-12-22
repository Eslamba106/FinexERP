<?php

namespace App\Http\Controllers\property_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Services\property_master\FloorServices;

class FloorController extends Controller
{
    public $floor_services;
    public function __construct(FloorServices $floor_services)
    {
        $this->floor_services = $floor_services;
    }
    public function index(Request $request)
    {
          // $this->authorize('complaints'); 
          $ids = $request->bulk_ids;
          if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
              $data = ['status' => 1, 'worker' => $request->worker];
              Floor::whereIn('id', $ids)->update($data);
              return back()->with('success', __('general.updated_successfully'));
          }
          $search      = $request['search'];
          $query_param = $search ? ['search' => $request['search']] : '';
          $main = Floor::when($request['search'], function ($q) use ($request) {
              $key = explode(' ', $request['search']);
              foreach ($key as $value) {
                  $q->Where('name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
              }
          })
              ->latest()->paginate()->appends($query_param);        $search = null;
        $data = [
            "main" => $main,
            "search" => $search,
        ];
        return view('admin-views.property_master_part_two.index', $data);
    }
    public function create()
    {
        return view('admin-views.property_master_part_two.create');
    }
    public function edit($id){
        $main = Floor::findOrFail($id);
        $data = [
            'main'=> $main
        ] ;
        if($main->mode == 'single'){
            return view('admin-views.property_master_part_two.single_edit', $data);

        }elseif($main->mode == 'multiple'){
            
            return view('admin-views.property_master_part_two.multiple_edit', $data);

        }
    }

    public function floor_single(Request $request)
    {
        try {
            // $data = $request->only(['floor_name' , 'floor_code']);
            $request->merge(['company_id' => auth()->id()]);
            $floor_services = $this->floor_services->storePropertyMasterModal($request);
            return redirect()->route('floor.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function floor_single_edit(Request $request , $id)
    {
        try {
            $request->merge(['company_id' => auth()->id()]);
            $floor_services = $this->floor_services->updatePropertyMasterModal($request);
            return redirect()->route('floor.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function floor_multiple(Request $request)
    {
        $data = [
            "fill_zero"                     => $request->fill_zero,
            "start_floor_no"                => $request->start_floor_no,
            "width"                         => $request->width,
            "floor_code_prefix_status"      => $request->floor_code_prefix_status,
            "floor_code_prefix"             => $request->floor_code_prefix ?? null,
            'no_of_floors'                  => $request->no_of_floors,
            "status"                        => $request->status
        ];
        return view('admin-views.property_master_part_two.floor_form', $data);
    }
    public function floor_multiple_store(Request $request)
    {
        try {
            for ($i = 0, $ii = count($request->floors); $i < $ii; $i++) {
                Floor::create([
                    'name'              => $request->floors[$i],
                    'code'              => $request->floor_code_prefix,
                    'floor_no'          => (isset($request->width)) ? (str_pad('', $request->width - 1, '0') . ($i + $request->start_floor_no)) : ($i + $request->start_floor_no),
                    'status'            => $request->status,
                    'mode'              => 'multiple',
                    'prefix'            => $request->floor_code_prefix ,
                    'width'             => $request->width ,
                    'company_id'        => auth()->id(),
                ]);
            }
            return redirect()->route('floor.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function floor_multiple_edit(Request $request , $id)
    {
        $floor = Floor::findOrFail($id);
        try {
            // for ($i = 0, $ii = count($request->floors); $i < $ii; $i++) {
                $floor->update([
                    'name'              => $request->floor_code_prefix .str_pad('', $request->width - 1, '0'). (int)$request->start_floor_no,
                    'code'              => $request->floor_code_prefix,
                    'floor_no'          => (str_pad('', $request->width - 1, '0') . ( (int)$request->start_floor_no)) ,
                    'status'            => $request->status,
                    'mode'              => 'multiple',
                    'prefix'            => $request->floor_code_prefix ,
                    'width'             => $request->width ,
                    'company_id'        => auth()->id(),
                ]);
            // }
            return redirect()->route('floor.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $floor = Floor::findOrFail($request->id);
        $floor->delete();
        return redirect()->route('floor.index')->with('success', __('property_master.deleted_successfully'));
    }
}
