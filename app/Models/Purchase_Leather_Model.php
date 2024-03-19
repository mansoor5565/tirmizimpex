<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Leather_Model extends Model
{
    use HasFactory;
    protected $table="purchase_leather";
    protected $primarykey="id";
    protected $fillable=['leather_vendor_id','total_cost'];

    
    public function leathervendors(){
        return $this->belongsTo(Leather_Vendor_Model::class,'leather_vendor_id');
    }
    public function leathertransaction(){
        return $this->belongsTo(Leather_Transaction_Model::class,'purchase_leather_id');
    }
    public function purchaseleathercolor(){
        return $this->hasMany(Purchase_Leather_Color_Model::class,'purchase_leather_id');
    }
}
