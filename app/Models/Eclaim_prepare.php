<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eclaim_prepare extends Model
{

    use HasFactory;

    protected $table = 'eclaim_prepare';
    public $timestamps = true;


    protected $primaryKey = 'id';

    protected $guarded = [];


    

    public function raw(){
        return $this->belongsTo(Eclaim_raw::class,'db_id');
            
        }


        public function master(){
            return $this->belongsTo(Eclaim_master::class,'master_file');
                
            }

    

                public function province(){
                    return $this->belongsTo(Provinces::class,'accprov', 'code');
                        
                    }


}
