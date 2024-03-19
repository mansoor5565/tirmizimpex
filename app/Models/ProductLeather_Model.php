<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLeather_Model extends Model
{
    use HasFactory;
    protected $table='product_colors';
    protected $primarykey = 'id';
    protected $fillable=['product_id','productcolor_id'];

}
