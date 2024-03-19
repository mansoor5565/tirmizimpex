<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Model extends Model
{
    use HasFactory;
    protected $table="product";
    protected $primarykey='id';
    protected $fillable=['name','color','model_no','image','cutting_cost','stitching_cost'];

}
