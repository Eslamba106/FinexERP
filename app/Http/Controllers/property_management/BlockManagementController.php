<?php

namespace App\Http\Controllers\property_management;

use App\Models\Block;
use Illuminate\Http\Request;
use App\Models\BlockManagement;
use App\Models\PropertyManagement;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlockManagementRequest;

class BlockManagementController extends Controller
{
    public function index(Request $request){
        // $this->authorize('block_management');
        $ids = $request->bulk_ids;
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $block_management = BlockManagement::join('blocks' , 'block_management.block_id', '=', 'blocks.id')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('blocks.name', 'like', "%{$value}%")
                    ->orWhere('block_management.id', $value);
            }
        })
        ->select('block_management.*', 'blocks.name as block_name')
        ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $block_management,
            'search'            => $search,


        ];
        return view("admin-views.property_management.block_management.index" , $data);
    }
    public function create(){
        // $this->authorize('create_block');

        $property_managements = PropertyManagement::all();
        $blocks = Block::all();
        $data = [
            "property_managements"             => $property_managements,
            "blocks"                            => $blocks,

        ];
        return view("admin-views.property_management.block_management.create" , $data);

    }

    public function store(Request $request){
        // $this->authorize('create_block');
        foreach($request->block_id as $id){
        BlockManagement::create([
            "block_id"=> $id,
            "property_management_id" => $request->property_management_id,
        ]);
        }
        return redirect()->route("block_management.index")->with("success",__('property_master.added_successfully'));
    }

    public function show($id){
        $this->authorize('show_block');

        $property = BlockManagement::findOrFail($id);
        $data = [
            'property'=> $property
        ];
        return view('admin-views.property_management.block_management.show', $data);
    }

    public function view_image($id){
        $this->authorize('show_image_block');

        $property = BlockManagement::findOrFail($id);
        $data = [
            'property'=> $property
        ];
        return view('admin-views.property_management.block_management.view_image', $data);
    }



    public function get_blocks_by_property(Request $request){
        $block_management = BlockManagement::where('property_management_id',$request->property_management_id)->pluck('block_id');

        $blocks = Block::whereNotIn('id', $block_management)->get();
        return json_encode($blocks);
    }
}
