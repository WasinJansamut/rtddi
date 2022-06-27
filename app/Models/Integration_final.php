<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration_final extends Model
{
    use HasFactory;

    protected $table = 'integration_final';
    public $timestamps = false;

    
    protected $primaryKey = 'DEAD_CONSO_REPORT_ID';

    protected $guarded = [];

    public function province(){
        return $this->belongsTo(Provinces::class,'AccProv', 'code');
            
        }

}
