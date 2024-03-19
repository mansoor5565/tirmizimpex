<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAccessories_Model extends Model
{
    use HasFactory;
    protected $table="productaccessories";
    protected $primarykey="id";
    protected $fillable=['product_id','accessories_id','quantity'];

    public function Accessories(){
        return $this->belongsTo(Accessories_Model::class,'accessories_id');
    }
}
