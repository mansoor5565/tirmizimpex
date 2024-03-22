<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Model;
class ProductSize_Model extends Model
{
    use HasFactory;
    protected $table="productsize";
    protected $primarykey='id';
    protected $fillable=['product_id','size'];
    public function product(){
        return $this->belongsTo(Product_Model::class,'product_id');
    }
}
