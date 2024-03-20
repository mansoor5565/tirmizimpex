<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor_Bill_Model extends Model
{
    use HasFactory;
    protected $table="vendor_bill";
    protected $primarykey="id";
    protected $fillable=['leather_vendor_id','remaining_balance'];

    public function leatherpurchase(){
        return $this->belongsTo(Purchase_Leather_Model::class,'leather_purchase_id');
    }
}
