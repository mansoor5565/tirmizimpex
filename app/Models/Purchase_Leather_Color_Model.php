<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Leather_Color_Model extends Model
{
    use HasFactory;
    protected $table="purchase_leather_color";
    protected $primarykey="id";
    protected $fillable=['purchase_leather_id','leather_color_id','cost_per_unit','quantity','total_cost'];

    public function purchaseleathers(){
        return $this->belongsTo(Purchase_Leather_Model::class,'purchase_leather_id');
    }

    public function leatherColors(){
        return $this->belongsTo(LeatherColor::class,'leather_color_id');
    }
    
}
