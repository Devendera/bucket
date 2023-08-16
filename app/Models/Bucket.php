<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $table = 'bucket';
    protected $fillable = [
        'name', 'volume','status'
    ];

    public function department()
    {
        return $this->hasOne('App\Models\Department','id','department_id');
    }
}