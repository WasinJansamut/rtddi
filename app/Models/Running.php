<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Running extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'running';
    public $timestamps = false;
    
    protected $primaryKey = 'id';
    
    protected $guarded = [];
}
