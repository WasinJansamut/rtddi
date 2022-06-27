<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deathcert_master extends Model
{
    use HasFactory;

    
    protected $table = 'deathcert_master';
    public $timestamps = true;

/*     protected $casts = [
        'cost' => 'float'
    ]; */

    protected $primaryKey = 'id';
 
    protected $fillable = [
        'filename',
        'note',
        'err',
        'war',
        'lost',
        'com',
        'rec_all',
        'status',
        'user_id'
    ];


 
     public function user(){
          
            return $this->belongsTo(User::class,'user_id');
                
            }  




}
