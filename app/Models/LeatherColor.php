<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Leather_Model;
class LeatherColor extends Model
{
    use HasFactory;
    protected $table='leather_colors';
    public function leathers(){
        return $this->belongsTo(Leather_Model::class,'leather_id');
    }

    public function leatherinventory(){
        return $this->hasMany(Leather_Inventory_Model::class,'leathercolor_id');
    }
    public function PurchaseLeathercolor(){
        return $this->hasMany(Purchase_Leather_Color_Model ::class,'leather_color_id');
    }
}
