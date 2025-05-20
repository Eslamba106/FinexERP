<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyManagement extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ownership(){
        return $this->belongsTo(Ownership::class,"ownership_id","id");
    }
    public function blocks_management_child(){
        return $this->hasMany(BlockManagement::class,"property_management_id","id");
    }
}
