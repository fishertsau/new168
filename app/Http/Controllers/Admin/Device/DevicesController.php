<?php

namespace App\Http\Controllers\Admin\Device;

use Illuminate\Http\Request;
use App\Repository\DeviceRepository;

/**
 * Class DevicesController
 * @package App\Http\Controllers\Admin\Device
 */
class DevicesController
{
    /**
     * @var DeviceRepository
     */
    private $deviceRepo;

    /**
     * DevicesController constructor.
     * @param DeviceRepository $deviceRepository
     */
    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepo = $deviceRepository;
    }


    /**
     * @param Request $request
     * @return \Acme\Tool\Filterable\models
     */
    public function getList(Request $request)
    {
        return $this->deviceRepo->getList($request->input('queryTerm'), 'admin');
    }
}
