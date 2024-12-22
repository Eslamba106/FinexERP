<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockManagement extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function block(){
        return $this->belongsTo(Block::class,"block_id","id");
    }
    public function property_block_management(){
        return $this->belongsTo(PropertyManagement::class,"property_management_id","id");
    }
}
