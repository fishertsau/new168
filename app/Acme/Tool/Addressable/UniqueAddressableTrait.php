<?php
namespace Acme\Tool\Addressable;

use App\Models\Address;

/**
 * Class UniqueAddressableTrait
 * @package Acme\Tool\Addressable
 */
trait UniqueAddressableTrait
{
    /**
     * Get the model's address.
     */
    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * @return string
     */
    public function getAddressAttribute()
    {
        return $this->getAddress();
    }


    public function getAddress()
    {
        $address = $this->address()->first();

        return $address ? $address : '';
    }

    public function deleteAddress()
    {
        return $this->address()->first()->delete();
    }

    public function getAddressTextAttribute()
    {
        $address = $this->address()->first();

        return $address ? $address->address_text : '尚未設定';
    }


    /**
     *  Only one address is allowed for each shop
     * @param array $addressInput
     */
    public function createOrUpdateAddress($addressInput = [])
    {
        //validate three fields are required
        // (1)city, (2)zip, (3)street

        if (!$this->address) {
            return $this->address()->create($addressInput);
        }

        return $this->address->update($addressInput);
    }
}