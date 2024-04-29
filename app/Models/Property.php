<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class)->withPivot('property_id' , 'facility_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
