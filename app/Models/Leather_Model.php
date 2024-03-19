<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LeatherColor;

class Leather_Model extends Model
{
    use HasFactory;
    protected $table = 'leather';
    protected $primarykey = 'id';
    protected $fillable = ['type'];
    public function leatherColors()
    {
        return $this->hasMany(LeatherColor::class, 'leather_id');
    }
    
}
