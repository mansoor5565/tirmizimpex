<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage_Model extends Model
{
    use HasFactory;
    protected $table="productimage";
    protected $primarykey="id";
    protected $fillable=['product_id','product_image'];
}
