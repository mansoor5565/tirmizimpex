<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Accessories_Model extends Model
{
    use HasFactory;
    protected $table="purchase_accessories";
    protected $primarykey="id";
    protected $fillable=['accessories_id','quantity','cost_per_unit'];

    public function accessories(){
        return $this->belongsTo(Accessories_Model::class,'accessories_id');
    }

}
