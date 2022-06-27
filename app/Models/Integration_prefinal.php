<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration_prefinal extends Model
{
    use HasFactory;

    protected $table = 'integration_prefinal';
    public $timestamps = false;


    protected $primaryKey = 'DEAD_CONSO_REPORT_ID';

    protected $guarded = [];


    public function province(){
        return $this->belongsTo(Provinces::class,'AccProv', 'code');

        }


        public function police_raw(){
            return $this->belongsTo(Police_raw::class,'id_raw_police', 'id');
            }


}
