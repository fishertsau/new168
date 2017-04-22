<?php

namespace App\Models;

use Acme\Tool\Ownable\Ownable;
use Acme\Tool\Productable\Productable;
use Acme\Tool\Addressable\Addressable;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use Acme\Tool\Productable\ProductableTrait;

class Vendor extends Model implements Ownable, Productable, Addressable
{
    use ProductableTrait;

    protected $guarded = [];

    protected $casts = [
        'maintenance_items' => 'array',
        'services' => 'array',
        'service_areas' => 'array',
        'published' => 'boolean',
        'could_maintain' => 'boolean',
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($vendor) {
            if ($vendor->hasDuplicateUser($vendor)) {
                return false;
            }
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasDuplicateUser($vendor)
    {
        return (Vendor::where('user_id', $vendor->user_id)->exists());
    }

    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function scopeLocation($query, $city = null, $zips = [])
    {
        if ($city != '') {
            if ($zips != '') {
                return $query
                    ->where('city', $city)
                    ->whereIn('zip', $zips);
            }

            return $query
                ->where('city', $city);
        }

//        $addressable_type = get_class(new Device);

//        if ($city != '') {
//            if ($areas != '') {
//                return $queryBuilder = $query
//                    ->select('devices.*', 'addresses.*')
//                    ->join('addresses', 'addresses.addressable_id', '=', 'devices.id')
//                    ->where('addressable_type', $addressable_type)
//                    ->where('city', $city)
//                    ->whereIn('zip', $areas);
//            }
//
//            return $queryBuilder = $query
//                ->select('devices.*', 'addresses.*')
//                ->join('addresses', 'addresses.addressable_id', '=', 'devices.id')
//                ->where('addressable_type', $addressable_type)
//                ->where('city', $city);
//        }

    }

    /**
     * //     * @param $query
     * //     * @param array $areas
     * //     * @return mixed
     * //     */
//    public
//    function scopeArea($query, $areas = [])
//    {
//        $addressable_type = get_class(new Device);
//
//        if (!is_array($areas)) {
//            $areas = [$areas];
//        }
//
//        if (!empty($areas[0])) {
//            return $query
//                ->select('devices.*', 'addresses.*')
//                ->join('addresses', 'addresses.addressable_id', '=', 'devices.id')
//                ->where('addressable_type', $addressable_type)
//                ->whereIn('zip', $areas);
//        }
//    }


}
