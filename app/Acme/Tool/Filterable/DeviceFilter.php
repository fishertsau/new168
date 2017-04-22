<?php

namespace Acme\Tool\Filterable;

use App\Models\Device\Device;


/**
 * Class DeviceFilter
 *
 */
class DeviceFilter extends Filterable
{
    public $queryTermKeys = [
        'keyword',
        'cat_id',
        'occasion',
        'price_lower',
        'price_upper',
        'voltage',
        'gas_type',
        'city',
        'zips',
        'order_by',
        'order_sequence'
    ];


    /**
     * @param $queryTerm
     * @param boolean $admin
     * @return mixed
     */
    protected function modelQueryBuilder(array $queryTerm, $admin)
    {
        return
            Device::published($admin)
                ->keyword($queryTerm['keyword'])
                ->gas($queryTerm['gas_type'])
                ->voltage($queryTerm['voltage'])
                ->cat($queryTerm['cat_id'])
                ->occasion($queryTerm['occasion'])
                ->location($queryTerm['city'], $queryTerm['zips'])
                ->priceRange($queryTerm['price_lower'],
                    $queryTerm['price_upper'])
                ->doOrderBy($queryTerm['order_by'],
                    $queryTerm['order_sequence']);

//        return
//            Device::
//            beforeDue();
    }

    /**
     *  Return the filtered list basing up query term.
     * @param array $queryTerm
     * @param bool $admin
     * @return models
     */
    public function getList($queryTerm = [], $admin = false)
    {
        $queryTerm = $this->organizeQueryTerm($queryTerm);

        return $this->modelQueryBuilder($queryTerm->toArray(), $admin)->paginate(10);
    }
}
