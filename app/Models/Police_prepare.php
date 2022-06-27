<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Police_prepare extends Model
{
    use HasFactory;

    protected $table = 'police_prepare';
    public $timestamps = true;


    protected $primaryKey = 'id';

    protected $guarded = [];



    public function raw(){
        return $this->belongsTo(Police_raw::class,'db_id');
            
        }


        public function master(){
            return $this->belongsTo(Police_master::class,'master_file');
                
            }

    

                public function province(){
                    return $this->belongsTo(Provinces::class,'accprov', 'code');
                        
                    }


}
