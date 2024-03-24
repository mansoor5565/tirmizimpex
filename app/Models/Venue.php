<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    protected $table="venue";
    protected $primarykey='id';
    protected $fillable=['name','buyer_name'];
}
