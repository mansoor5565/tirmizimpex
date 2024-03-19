<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leather_Inventory_Model extends Model
{
    use HasFactory;
    protected $table="leather_inventory";
    protected $primarykey="id";
    protected $fillable=['lot_no','leather_id','quantity_on_hand'];

    public function leathercolors(){
        return $this->belongsTo(LeatherColor::class,'leathercolor_id');
    }
    
}
