<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population_master extends Model
{
    use HasFactory;


    protected $table = 'population_master';
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
            // ให้ฟิลนี้  ไปสัมพันธ์กับโมเดล User โดยมี user_id เป็น FK
            return $this->belongsTo(User::class,'user_id');
                
            }  





}
