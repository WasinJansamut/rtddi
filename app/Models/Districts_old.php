<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deathcert_master extends Model
{
    use HasFactory;


    protected $table = 'districts';
    public $timestamps = true;

/*     protected $casts = [
        'cost' => 'float'
    ]; */

    protected $primaryKey = 'id';

    protected $guarded = [];
}
