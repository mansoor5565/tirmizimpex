<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSize_Model;
use App\Models\ProductImage_Model;
class Product_Model extends Model
{
    use HasFactory;
    protected $table="product";
    protected $primarykey='id';
    protected $fillable=['name','color','model_no','image','cutting_cost','stitching_cost'];
    public function sizes(){
        return $this->hasMany(ProductSize_Model::class,'product_id');
    }
    public function images(){
        return $this->hasMany(ProductImage_Model::class,'product_id');
    }
}
