<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessories_Model extends Model
{
    use HasFactory;
    protected $table="accessories";
    protected $primarykey="id";
    protected $fillable=['name','type','cost_per_unit','unit'];

    public function productaccessories()
    {
        return $this->hasMany(ProductAccessories_Model::class, 'accessories_id');
    }

    public function purchaseaccessories()
    {
        return $this->hasMany(Purchase_Accessories_Model::class, 'accessories_id');
    }

    public function accessoriesinventory(){
        return $this->hasMany(Accessories_Inventory_Model::class,'accessories_id');
    }
}
