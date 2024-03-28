<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leather_Transaction_Model extends Model
{
    use HasFactory;
    protected $table="leather_transaction";
    protected $primarykey="id";
    protected $fillable=['purchase_leather_id','transaction_date','transaction_type'];

    public function purchaseLeatherInfo(){
        return $this->belongsTo(Purchase_Leather_Model::class,'purchase_leather_id');
    }

}
