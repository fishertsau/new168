<?php


namespace App\Repository;


use App;
use App\User;
use App\Models\Device\Device;
use Acme\Tool\Filterable\DeviceFilter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class DeviceRepository
 * @package App\Http\Controllers\repository
 */
class DeviceRepository
{
    /**
     * @var DeviceFilter
     */
    public $deviceFilter;

    /**
     * DeviceRepository constructor.
     * @param DeviceFilter $deviceFilter
     */
    public function __construct(DeviceFilter $deviceFilter)
    {
        $this->deviceFilter = $deviceFilter;
    }

    /**
     * @param Device $device
     * @return bool
     * @throws \Exception
     */
    public function destroy(Device $device)
    {
        return $device->delete();
    }


    /**
     * @param Device $device
     * @param $input
     * @return null|static
     */
    public function update(Device $device, $input)
    {
        $input = collect($input);

        $device->update($input->except('occasion')->toArray());


        if ($input->has('occasion')) {
            $this->syncOccasions($device, $input['occasion']);
        }

        return $device->fresh();
    }


    /**
     * @param array $input
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $input, User $user)
    {
        return $user->devices()->create($input);
    }

    /**
     * @param array $queryTerm
     * @param string $queriedBy
     * @return \Acme\Tool\Filterable\models
     */
    public function getList($queryTerm = [], $queriedBy = '')
    {
        return $this->deviceFilter
            ->getList($queryTerm, $queriedBy === 'admin');
    }


    public function syncOccasions(Device $device, array $occasions = [])
    {
        $occasions = ($occasions == null) ? [] : $occasions;
        $device->occasions()->sync($occasions);
    }


    public function findBySN($serialNum)
    {
        if (!$device = Device::where('sn', $serialNum)->first()) {
            throw new ModelNotFoundException;
        }

        return $device;
    }
}