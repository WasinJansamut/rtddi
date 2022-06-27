<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eclaim_raw extends Model
{
    use HasFactory;

     
    protected $table = 'eclaim_raw';
    public $timestamps = true;

    
    protected $primaryKey = 'id';

    protected $guarded = [];



}
