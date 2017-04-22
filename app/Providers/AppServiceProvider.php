<?php

namespace App\Providers;

use App\User;
use App\Models\Vendor;
use App\Models\Occasion;
use App\Models\Device\Device;
use Acme\Auth\SocialiteGateway;
use App\Models\Authorization\Role;
use Laravel\Dusk\DuskServiceProvider;
use Acme\Auth\LaravelSocialiteGateway;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('device', function () {
            return new Device();
        });

        $this->app->bind('vendor', function () {
            return new Vendor();
        });

        $this->app->bind('user', function () {
            return new User();
        });


        $this->app->bind(SocialiteGateway::class, function () {
            return new LaravelSocialiteGateway;
        });


        /***  Left Menu Show �]�w***/
        view()->composer(['admin.layouts.default'], function ($view) {
            $view->with('left_menu_show', session('left_menu_show'));
        });

        /** *** frontend Company Info ******/
        view()->composer(['*'], function ($view) {
            $view->with('company_name', '金豪買');
            $view->with('company_tel', '04-22226688');
            $view->with('company_fax', '04-22226688');
            $view->with('company_address', '台中市中區中正路1號');
            $view->with('company_email', 'service@168.com.tw');
            $view->with('gear_cat_list', $this->getGearCatList());
        });

        /***  �ϥΪ̺޲z****/
        view()->composer(['admin.user._form'], function ($view) {
            $view->with('roleList', Role::getRoleList());
        });


        /** �\���]��  �ϥγ��X*/
        view()->composer(['admin.device.*'], function ($view) {
            $view->with('occasion_list', Occasion::pluck('title', 'id'));
        });
        view()->composer(['frontEnd.components.gearSearch.gearSearchBlock'], function ($view) {
            $view->with('occasions', $this->getOrderedOccasions());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }


    protected function getGearCatList()
    {
        return json_decode(Storage::get('gearCat.json'));
    }

    protected function getOrderedOccasions()
    {
        return Occasion::orderBy('rank')->get();
    }
}
