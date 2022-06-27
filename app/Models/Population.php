<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;


    protected $table = 'population';
    public $timestamps = true;

/*     protected $casts = [
        'cost' => 'float'
    ]; */

    protected $primaryKey = 'ID_POPULATION';
 
    protected $fillable = [
        'YEAR',
        'PROV',
        'AMOUNT'
    ];

}
