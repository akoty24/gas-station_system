<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function readings()
    {
        return $this->hasMany(Readings::class, 'shift_id');
    }

    public function totals()
    {
        return $this->hasMany(Total::class, 'shift_id');
    }

    public function getPreviousReadings()
    {
        $previousShift = Shift::latest()->first();
        if ($previousShift) {
            return $previousShift->readings()->get();
        }
        return null;
    }
        
    }

