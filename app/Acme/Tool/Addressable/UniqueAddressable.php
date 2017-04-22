<?php


namespace Acme\Tool\Addressable;


/**
 * Interface UniqueAddressable
 * @package Acme\Tool\Addressable
 */
interface UniqueAddressable
{
    /**
     *  a model could have many addresses
     * Get the model's address.
     * return $this->morphMany(Address::class, 'addressable');
     */
    public function address();

    public function getAddressAttribute();

    public function getAddress();

    public function deleteAddress();

    public function getAddressTextAttribute();

    /**
     *  Only one address is allowed for each shop
     * @param array $addressInput
     */
    public function createOrUpdateAddress($addressInput = []);
}