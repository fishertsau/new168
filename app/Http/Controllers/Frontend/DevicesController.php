<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Models\Device\Device;
use App\Service\DeviceService;
use App\Repository\DeviceRepository;
use App\Http\Controllers\Controller;
use Acme\Tool\Request\RequestService;


/**
 * Class DevicesController
 * @package App\Http\Controllers\Frontend
 */
class DevicesController extends Controller
{
    private $deviceService;
    private $userService;

    /**
     * @var DeviceRepository
     */
    private $deviceRepo;
    /**
     * @var RequestService
     */
    private $requestService;

    /**
     * @param RequestService $requestService
     * @param DeviceRepository $deviceRepository
     * @param DeviceService $deviceService
     * @param UserService $userService
     * @internal param Request $request
     */
    public function __construct(
        RequestService $requestService,
        DeviceRepository $deviceRepository,
        DeviceService $deviceService,
        UserService $userService
    )
    {
        $this->middleware('auth')->except(['index', 'show', 'getList']);
        $this->middleware("modelOwner:device")->only(['update', 'edit', 'destroy']);
        $this->middleware("verified")->only(['update', 'edit', 'destroy']);
        $this->deviceService = $deviceService;
        $this->userService = $userService;
        $this->deviceRepo = $deviceRepository;
        $this->requestService = $requestService;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.devices.index.index');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $userDevices = auth()->user()->devices()->get();
        return view('frontend.devices.create.create', compact('userDevices'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        $device = Device::with(['occasions', 'photos'])->findOrFail($id);

        $user = $this->userService->getUserForPublicUse();
        return view('frontend.devices.edit.edit', compact('device', 'user'));
    }


    /**
     * @param Device $device
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Device $device, Request $request)
    {
        $input = collect($request->except('guarantee_content'));

        if ($input->has('specs')) {
            $input['specs'] = $this->requestService->transposeArrayInput(
                $input['specs'], ['title', 'description']);
        }

        $this->deviceRepo->update($device, $input);
        return redirect(route('devices.show', $device->id));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function store(Request $request)
    {
        $device = $this->deviceRepo->store($request->only(['cat_id', 'title']), Auth::user());
        return redirect(route('devices.edit', $device->id));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param Device $device
     */
    public
    function show($id)
    {
        $device = Device::with('occasions')->with('photos')->findOrFail($id);

        if ($this->authUserOwns($device)) {
            return $this->showDevice($device);
        }

        if (!$device->published) {
            return redirect(route('devices.index'));
        }

        return $this->showDevice($device);
    }


    private
    function showDevice(Device $device)
    {
        $device->increment('reads');
        $user = $this->userService->getUserForPublicUse();
        return view('frontend.devices.show.show', compact('device', 'user'));
    }


    /**
     * @param Device $device
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function destroy(Device $device)
    {
        $this->deviceRepo->destroy($device);
        return redirect(route('account'));
    }


    /**
     * @param $command
     * @param $data
     * @param Request $request
     * @return bool|mixed
     */
    public
    function ajaxHandler($command, $data, Request $request)
    {
        //some commands are only allowed for the owner
        //
        return $this->deviceService->ajaxHandler($command, $data, $request);
    }


    /**
     * @param Request|null $request
     * @return \Acme\Tool\Filterable\model
     */
    public
    function getList(Request $request = null)
    {
        return $this->deviceRepo->getList($request->input('queryTerm'));
    }

    /**
     * @param $device
     * @return bool
     */
    private
    function authUserOwns($device)
    {
        return ($user = Auth::user()) && ($device->ownedBy($user));
    }

//    /**
//     * @return $this|null
//     */
//    private function getUserForPublicUse()
//    {
//        return $this->userService->getUserForPublicUse();
//    }
}
