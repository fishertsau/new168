<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Repository\AddressRepository;
use App\Repository\ProductRepository;
use Acme\Tool\Request\RequestService;
use App\Http\Controllers\Controller;

/**
 * Class VendorsController
 * @package App\Http\Controllers\Frontend
 */
class VendorsController extends Controller
{
    private $userRepo;
    /**
     * @var ProductRepository
     */
    private $proRepo;
    /**
     * @var AddressRepository
     */
    private $addRepo;

    private $requestService;

    /**
     * @param Request $request
     * @param UserRepository $userRepo
     * @param ProductRepository $proRepo
     * @param AddressRepository $addRepo
     * @param RequestService $requestService
     */
    public function __construct(
        UserRepository $userRepo,
        ProductRepository $proRepo,
        AddressRepository $addRepo,
        RequestService $requestService
    )
    {
        $this->middleware('auth')->except(['index', 'show', 'getList']);
        $this->middleware("modelOwner:vendor")->only(['update', 'edit', 'destroy']);
        $this->userRepo = $userRepo;
        $this->proRepo = $proRepo;
        $this->addRepo = $addRepo;
        $this->requestService = $requestService;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (!auth()->user()->verified) {
            return redirect('account')->with('status_danger',
                '您需要先認證您的電子信箱,才能建立廠商!');
        }

        if (!(($vendor = auth()->user()->fresh()->vendor) === null)) {
            return redirect(route('vendors.edit', $vendor->id));
        };

        return view('frontend.vendors.create.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (!auth()->user()->verified) {
            return redirect('account');
        }

        $vendor = $this->userRepo
            ->createOrUpdateVendor(Auth::user(), $request->all());

        return redirect(route('vendors.edit', $vendor->id));
    }


    /**
     * @param $vendorId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($vendorId)
    {
        if (!auth()->user()->verified) {
            return redirect('account')
                ->with('status_danger', '您需要先認證您的電子信箱,才能編輯廠商!');
        }

        $vendor = Vendor::findOrFail($vendorId);

        return view('frontend.vendors.edit.edit', compact('vendor'));
    }

    /**
     * @param Vendor $vendor
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param $id
     */
    public function update(Vendor $vendor, Request $request)
    {
        if (!auth()->user()->verified) {
            return redirect('account');
        }

        //input validate
        //if maintenance is yes, should have maintenance items

        $vendor->update($request->except(['products', 'addresses']));

        $this->saveProducts($vendor, $request);
        $this->saveAddresses($vendor, $request);

        return redirect(route('vendors.show', $vendor->id));
    }


    /**
     * @param $id
     * @return string
     */
    public function show($id)
    {
        if (!$vendor = Vendor::find($id)) {
            return redirect(route('vendors.index'));
        };

        if (auth()->check() && ($vendor->ownedBy(auth()->user()))) {
            return view('frontend.vendors.show.show', compact('vendor'));
        }

        if ((!$vendor->published) || (!$vendor->user->verified)) {
            return redirect(route('vendors.index'));
        }

        return view('frontend.vendors.show.show', compact('vendor'));
    }


    public function index()
    {
        return view('frontend.vendors.index.index');
    }

    /**
 * @param Vendor $vendor
 * @param Request $request
 */
    private function saveProducts(Vendor $vendor, Request $request)
    {
        if ($request->has('products')) {
            $productInput = $this->requestService->transposeArrayInput(
                $request->input('products'), ['title', 'description']);
            $this->proRepo->saveModelProduct($vendor, $productInput);
        }
    }

    /**
     * @param Vendor $vendor
     * @param Request $request
     */
    private function saveAddresses(Vendor $vendor, Request $request)
    {
        if ($request->has('addresses')) {
            $siteInput = $this->requestService->transposeArrayInput($request->input('addresses'),
                ['city', 'zip', 'street']);
            $this->addRepo->saveModelAddress($vendor, $siteInput);
        }
    }
}
