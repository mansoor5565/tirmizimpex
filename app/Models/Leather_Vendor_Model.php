<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leather_Vendor_Model extends Model
{
    use HasFactory;
    protected $table="leather_vendor";
    protected $primarykey="id";
    protected $fillable=['name','address','contact_number'];

    public function purchase_leather(){
        return $this->hasMany(Purchase_Leather_Model::class,'leather_vendor_id');
    }
}
