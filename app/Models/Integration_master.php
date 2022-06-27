<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration_master extends Model
{
    use HasFactory;


    protected $table = 'integration_master';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user(){
          
        return $this->belongsTo(User::class,'user_id');
            
        }  
}
