<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * @package Acme\Tool\Addressable\Models
 */
class Address extends Model
{
    protected $fillable = ['city', 'zip', 'street'];

//    protected $appends = ['area'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

//        static::creating(function ($address) {
//            if (!$address->areaInCity($address))
//                throw new Exception('Area zip is not in City');
//        });
    }


//    protected function areaInCity($address)
//    {
//        return $address->area->city_id == $address->city->id;
//    }


    /**
     * Get all of the owning addressable models.
     */
    public function addressable()
    {
        return $this->morphTo();
    }

//    public function getCityAttribute($value)
//    {
//        return City::whereId($value)->first();
//
//        if (!$city = City::whereId($value)->first()) {
//            return new Exception('City is not found.');
//        }
//
//        return $city;
//    }


//    public function getAreaAttribute($value)
//    {
//        return Area::whereZip($value)->first();
//
//        if (!$area = Area::whereZip($value)->first()) {
//            throw new Exception('Area is not found');
//        }
//        return $area;
//    }
//
//
//    public function getAddressTextAttribute()
//    {
//        return $this->city->title . $this->zip . $this->area->title . $this->street;
//    }
}
