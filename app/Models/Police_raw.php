<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Police_raw extends Model
{
    use HasFactory;

    
    protected $table = 'police_raw';
    public $timestamps = true;

    
    protected $primaryKey = 'id';

    protected $guarded = [];

 
}
