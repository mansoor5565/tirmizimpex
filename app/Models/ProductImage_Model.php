<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Model;
class ProductImage_Model extends Model
{
    use HasFactory;
    protected $table="productimage";
    protected $primarykey="id";
    protected $fillable=['product_id','product_image'];
    public function products(){
        return $this->belongsTo(Product_Model::class,'product_id');
    }
}
