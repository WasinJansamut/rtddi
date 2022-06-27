<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policestation extends Model
{
    use HasFactory;



    protected $table = 'police_station';
    public $timestamps = true;

/*     protected $casts = [
        'cost' => 'float'
    ]; */

    protected $primaryKey = 'ORG_CODE';
 
    protected $guarded = [];


}
