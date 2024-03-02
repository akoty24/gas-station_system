<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function readings()
    {
        return $this->hasMany(Readings::class, 'device_id');
    }
}
