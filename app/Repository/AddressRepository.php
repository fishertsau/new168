<?php


namespace App\Repository;


use Acme\Tool\Addressable\Addressable;

class AddressRepository
{
    public function saveModelAddress(Addressable $model, $addressInput)
    {
        $model->addresses()->delete();

        collect($addressInput)->each(function ($item) use ($model) {
            $model->addresses()->create($item);
        });
    }
}