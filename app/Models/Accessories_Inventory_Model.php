<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessories_Inventory_Model extends Model
{
    use HasFactory;
    protected $table="accessories_inventory";
    protected $primarykey="id";
    protected $fillable=['accessories_id','quantity_on_hand'];

    public function accessories(){
        return $this->belongsTo(Accessories_Model::class,'accessories_id');
    }
}
