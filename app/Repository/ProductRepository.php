<?php


namespace App\Repository;

use Acme\Tool\Productable\Productable;

class ProductRepository
{
    public function saveModelProduct(Productable $model, $input)
    {
        $model->products()->delete();

        collect($input)->each(function ($item) use ($model) {
            $model->products()->create($item);
        });
    }
}