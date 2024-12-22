<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorManagement extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function block(){
        return $this->belongsTo(Block::class,"block_id","id");
    }
    public function property_floor_management(){
        return $this->belongsTo(PropertyManagement::class,"property_management_id","id");
    }
}
