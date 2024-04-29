<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'cityName',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class)->withPivot('country_id' , 'city_id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
