<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'countryName',
    ];


    public function cities()
    {
        return $this->belongsToMany(City::class)->withPivot('country_id' , 'city_id');
    }


    public function properties()
    {
        return $this->belongsToMany(Property::class);
    } 
    
}
