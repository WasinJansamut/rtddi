<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'log';
    public $timestamps = true;
    
    protected $primaryKey = 'id';
    
    protected $guarded = [];

    public function user(){
        // ให้ฟิลนี้  ไปสัมพันธ์กับโมเดล User โดยมี user_id เป็น FK
        return $this->belongsTo(User::class,'user_id');
            
        }  
        
}
