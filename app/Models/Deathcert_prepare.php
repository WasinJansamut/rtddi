<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deathcert_prepare extends Model
{
    use HasFactory;

      
    protected $table = 'deathcert_prepare';
    public $timestamps = true;


    protected $primaryKey = 'id';

    protected $guarded = [];



    public function raw(){
        // ให้ฟิลนี้  ไปสัมพันธ์กับโมเดล Deathcert_raw โดยมี db_id เป็น FK
        return $this->belongsTo(Deathcert_raw::class,'db_id');
            
        }


        public function master(){
            return $this->belongsTo(Deathcert_master::class,'master_file');
                
            }

    

                public function province(){
                    return $this->belongsTo(Provinces::class,'accprov', 'code');
                        
                    }

}
