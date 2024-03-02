<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }  public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
