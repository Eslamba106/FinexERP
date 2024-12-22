<?php

namespace App\Http\Controllers\property_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Services\property_master\UnitServices;

class UnitController extends Controller
{
    public $unit_services;
    public function __construct(UnitServices $unit_services)
    {
        $this->unit_services = $unit_services;
    }
    public function index(Request $request)
    {
          // $this->authorize('complaints'); 
          $ids = $request->bulk_ids;
          if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
              $data = ['status' => 1, 'worker' => $request->worker];
              Unit::whereIn('id', $ids)->update($data);
              return back()->with('success', __('general.updated_successfully'));
          }
          $search      = $request['search'];
          $query_param = $search ? ['search' => $request['search']] : '';
          $main = Unit::when($request['search'], function ($q) use ($request) {
              $key = explode(' ', $request['search']);
              foreach ($key as $value) {
                  $q->Where('name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
              }
          })
              ->latest()->paginate()->appends($query_param);
  
        $search = null;
        $data = [
            "main" => $main,
            "search" => $search,
        ];
        return view('admin-views.property_master_part_two.index_unit', $data);
    }
    public function create()
    {
        return view('admin-views.property_master_part_two.create_unit');
    }
    public function edit($id)
    {
        $main = Unit::findOrFail($id);
        $data = [
            'main' => $main
        ];
        if ($main->mode == 'single') {
            return view('admin-views.property_master_part_two.single_edit_unit', $data);
        } elseif ($main->mode == 'multiple') {

            return view('admin-views.property_master_part_two.multiple_edit_unit', $data);
        }
    }

    public function unit_single(Request $request)
    {
        try {
            // $data = $request->only(['unit_name' , 'unit_code']);
            $request->merge(['company_id' => auth()->id()]);
            $unit_services = $this->unit_services->storePropertyMasterModal($request);
            return redirect()->route('unit.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function unit_single_edit(Request $request, $id)
    {
        try {
            $request->merge(['company_id' => auth()->id()]);
            $unit_services = $this->unit_services->updatePropertyMasterModal($request);
            return redirect()->route('unit.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function unit_multiple(Request $request)
    {
        $data = [
            "fill_zero"                     => $request->fill_zero,
            "start_unit_no"                => $request->start_unit_no,
            "width"                         => $request->width,
            "unit_code_prefix_status"      => $request->unit_code_prefix_status,
            "unit_code_prefix"             => $request->unit_code_prefix ?? null,
            'no_of_units'                  => $request->no_of_units,
            "status"                        => $request->status
        ];
        return view('admin-views.property_master_part_two.unit_form', $data);
    }
    public function unit_multiple_store(Request $request)
    {
        try {
            for ($i = 0, $ii = count($request->units); $i < $ii; $i++) {
                Unit::create([
                    'name'              => $request->units[$i],
                    'code'              => $request->unit_code_prefix,
                    'unit_no'          => (isset($request->width)) ? (str_pad('', $request->width - 1, '0') . ($i + $request->start_unit_no)) : ($i + $request->start_unit_no),
                    'status'            => $request->status,
                    'mode'              => 'multiple',
                    'prefix'            => $request->unit_code_prefix,
                    'width'             => $request->width,
                    'company_id'        => auth()->id(),
                ]);
            }
            return redirect()->route('unit.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function unit_multiple_edit(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        try {
            $unit->update([
                'name'              => $request->unit_code_prefix . str_pad('', $request->width - 1, '0') . (int)$request->start_unit_no,
                'code'              => $request->unit_code_prefix,
                'unit_no'          => (str_pad('', $request->width - 1, '0') . ((int)$request->start_unit_no)),
                'status'            => $request->status,
                'mode'              => 'multiple',
                'prefix'            => $request->unit_code_prefix,
                'width'             => $request->width,
                'company_id'        => auth()->id(),
            ]);
            return redirect()->route('unit.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $unit = Unit::findOrFail($request->id);
        $unit->delete();
        return redirect()->route('unit.index')->with('success', __('property_master.deleted_successfully'));
    }
}
