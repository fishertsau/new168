<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Models\Device\Device;
use App\Repository\DeviceRepository;
use App\Http\Controllers\Controller;

class DevicesController extends Controller
{
    /**
     * @var DeviceRepository
     */
    private $deviceRepo;


    /**
     * DevicesController constructor.
     * @param DeviceRepository $deviceRepository
     */
    public function   __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepo = $deviceRepository;
    }

    public function store(Request $request)
    {
        $device = $this->deviceRepo
            ->store($request->only(['cat_id', 'title']), Auth::user());

        return response()->json([
            'status' => 'success',
            'message' => 'device created',
            'device' => $device
        ], 200);
    }

    public function update(Request $request, $sn)
    {
        $device = $this->deviceRepo->findBySN($sn);

        $input = collect($request->except('guarantee_content', 'token','cat'));

        $device = $this->deviceRepo->update($device, $input);

        return response()->json([
            'status' => 'success',
            'message' => 'device updated',
            'device' => $device
        ], 200);
    }

    public function show($serialNum)
    {
        $device = $this->deviceRepo->findBySN($serialNum);

        return response()->json([
            'status' => 'success',
            'message' => 'a device is queried',
            'device' => $device
        ]);
    }
}
