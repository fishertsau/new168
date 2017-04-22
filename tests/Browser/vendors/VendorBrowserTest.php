<?php

namespace Tests\Browser\vendors;

use App;
use App\User;
use App\Models\Vendor;

use Tests\Browser\Pages\HomePage;
use Tests\Browser\Pages\UserAccount\SignIn;
use Tests\Browser\Pages\UserAccount\Account;

use Tests\Browser\Pages\vendors\VendorEdit;
use Tests\Browser\Pages\vendors\VendorInfo;
use Tests\Browser\Pages\vendors\VendorQuery;
use Tests\Browser\Pages\vendors\VendorCreation;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


/**
 * @group tdd
 * @group browser
 * @group vendor
 */
class VendorBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $testModules = [
        'create',
        'edit',
        'update',
        'see',
//        'query',
//        'others'
    ];

    /**
     * A Dusk test example.
     * @test
     *
     * @group vendor
     * @return void
     */
    public function main()
    {
        $this->testModules = collect($this->testModules);

        $this->browse(function ($browser) {

            //guidance after registration


            //create
            if ($this->testModules->contains('create')) {
                $this->an_user_can_create_vendor($browser);
                $this->vendor_creation_is_disallowed_without_enough_info($browser);
                $this->each_user_can_only_create_at_most_one_vendor($browser);
                $this->unVerified_user_is_not_allowed_to_create_vendor($browser);
                $this->only_signed_in_user_can_create_vendor($browser);
            }

            //edit
            if ($this->testModules->contains('edit')) {
                $this->an_user_can_edit_and_update_vendor_profile($browser);
                $this->edit_not_allowed_for_unverified_account($browser);
                $this->edit_is_disallowed_for_unSignedIn_user($browser);
                $this->edit_not_allowed_if_not_owner($browser);
            }

            //update
            if ($this->testModules->contains('update')) {
                $this->update_is_disallowed_without_enough_info($browser);
                $this->update_is_disallowed_for_unVerified_account($browser);
                $this->update_is_disallowed_for_unSingedIn_user($browser);
            }

            //see
            if ($this->testModules->contains('see')) {
                $this->can_see_vendorInfo($browser);
                $this->cannot_see_if_vendor_is_not_unpublished($browser);
                $this->cannot_see_if_no_vendor_found($browser);
                $this->owner_can_see_its_unpublished_vendor($browser);
                $this->could_not_be_seen_if_vendors_account_is_not_verified($browser);
            }


            //query
            if ($this->testModules->contains('query')) {
                $this->can_see_vendorInfo($browser);
                //not allowed if vendor is not published
                //not allowed if no vendor found
                //only owner can see unpublished vendor
                $this->can_query_vendors($browser);
                //can only query published vendors
                //can not be seen if account is unverified
            }


            //others
            if ($this->testModules->contains('others')) {
                //no vendor if account vendor is not created

                //update log
                //owner can see update log

                //products
                //service
                //address
            }
        });
    }


    private function an_user_can_create_vendor(Browser $browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $browser->loginAs($user);

        $browser->visit(new VendorCreation)
            ->assertSeeVendorCreation();

        $browser->doVendorCreate([
            'title' => 'An wonderful Vendor',
        ]);

        $browser->assertVendorCreated($user->vendor);

        $browser->logout();
    }


    private function vendor_creation_is_disallowed_without_enough_info(Browser $browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $browser->loginAs($user);


        //no input
        $browser->visit($currentPage = new VendorCreation)
            ->assertSeeVendorCreation()
            ->doVendorCreate([])
            ->on($currentPage);


        //no title
        $browser->visit($currentPage = new VendorCreation)
            ->assertSeeVendorCreation()
            ->doVendorCreate([
                'title' => ''
            ])
            ->on($currentPage);


        /*** ***************/
        //no cat
        //no vendor type
        /*** ***************/

        $browser->logout();
    }


    private function each_user_can_only_create_at_most_one_vendor(Browser $browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $browser->loginAs($user);
        $vendor = factory(Vendor::class)->create(['user_id' => $user->id]);

        $browser->visit(route('vendors.create'))
            ->on(new VendorEdit($vendor));

        $browser->logout();
    }


    private function unVerified_user_is_not_allowed_to_create_vendor(Browser $browser)
    {
        $user = factory(User::class)->states('unverified')->create();
        $browser->loginAs($user);

        $browser
            ->visit($currentPage = new HomePage)
            ->visit(route('vendors.create'))
            ->on(new Account($user))
            ->assertSeeUnverifiedWarning('建立廠商');

        $browser->logout();
    }


    private function only_signed_in_user_can_create_vendor(Browser $browser)
    {
        $browser->logout();

        //redirect back to old page
        $browser
            ->visit($currentPage = new HomePage)
            ->visit(route('vendors.create'))
            ->on(new SignIn);

        $browser->logout();
    }


    private function an_user_can_edit_and_update_vendor_profile(Browser $browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $vendor = factory(Vendor::class)->create([
            'title' => 'new vendor',
            'user_id' => $user->id
        ]);

        $browser->loginAs($user);
        $browser->visit(new VendorEdit($vendor))
            ->assertSeeVendorEdit($vendor)
            ->doVendorUpdate(['title' => 'a super new vendor'])
            ->on(new VendorInfo($vendor));

        $browser->logout();
    }


    private function edit_not_allowed_for_unverified_account($browser)
    {
        $user = factory(User::class)->states('unverified')->create();
        $vendor = factory(Vendor::class)->create([
            'title' => 'new vendor',
            'user_id' => $user->id
        ]);

        $browser->loginAs($user);

        $browser->visit(route('vendors.edit', $vendor->id))
            ->on(new Account($user))
            ->assertSeeUnverifiedWarning('編輯廠商');

        $browser->logout();
    }


    private function edit_not_allowed_if_not_owner($browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $vendor = factory(Vendor::class)->create([
            'title' => 'new vendor',
            'user_id' => $user->id
        ]);

        $newUser = factory(User::class)->states('verified')->create();

        $browser->loginAs($newUser);

        $browser
            ->visit($currentPage = new HomePage)
            ->visit(route('vendors.edit', $vendor->id))
            ->on($currentPage);

        $browser->logout();
    }


    private function edit_is_disallowed_for_unSignedIn_user($browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $vendor = factory(Vendor::class)->create([
            'title' => 'new vendor',
            'user_id' => $user->id
        ]);
        $browser->logout();

        $browser->visit(route('vendors.edit', $vendor->id))
            ->on(new SignIn());
    }

    private function update_is_disallowed_without_enough_info($browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $browser->loginAs($user);

        //no input
        $browser->visit($currentPage = new VendorCreation)
            ->assertSeeVendorCreation()
            ->doVendorCreate([])
            ->on($currentPage);

        //no title
        $browser->visit($currentPage = new VendorCreation)
            ->assertSeeVendorCreation()
            ->doVendorCreate([
                'title' => ''
            ])
            ->on($currentPage);

        /*** ***************/
        //no cat
        //no vendor type
        //no contact tel
        /*** ***************/

        $browser->logout();
    }

    private function update_is_disallowed_for_unVerified_account($browser)
    {
        //This is tested in vendor feature test.
    }


    private function update_is_disallowed_for_unSingedIn_user($browser)
    {
        //This is tested in vendor feature test.
    }


    private
    function can_see_vendorInfo(Browser $browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $vendor = factory(Vendor::class)->states('published')->create([
            'title' => 'new vendor',
            'user_id' => $user->id
        ]);

        $browser->visit(new VendorInfo($vendor))
            ->assertSeeVendorDetail($vendor);
    }


    private function cannot_see_if_vendor_is_not_unpublished(Browser $browser)
    {
        $user = factory(User::class)->states('verified')->create();
        $vendor = factory(Vendor::class)->states('unpublished')->create([
            'title' => 'new vendor',
            'user_id' => $user->id
        ]);

        $browser->visit(route('vendors.show', $vendor->id))
            ->on(new VendorQuery);
    }

    private function cannot_see_if_no_vendor_found(Browser $browser)
    {
        $vendorCount = Vendor::all()->count();

        $browser->visit(route('vendors.show', $vendorCount + 1))
            ->on(new VendorQuery);
    }

    private function owner_can_see_its_unpublished_vendor(Browser $browser)
    {
        $user = factory(User::class)->create();
        $vendor = factory(Vendor::class)->states('unpublished')->create([
            'user_id' => $user->id
        ]);

        $browser->loginAs($user);

        $browser->visit(new VendorInfo($vendor))
            ->assertSeeVendorDetail($vendor);
    }

    private function could_not_be_seen_if_vendors_account_is_not_verified(Browser $browser)
    {
        $user = factory(User::class)->states('unverified')->create();
        $vendor = factory(Vendor::class)->states('published')
            ->create(['user_id' => $user->id]);


        $browser->visit(route('vendors.show', $vendor->id))
            ->on(new VendorQuery());
    }


    private function can_query_vendors(Browser $browser)
    {
        $browser->visit(new VendorQuery)
            ->assertSeeVendorQuery();

//        $keyword = 'keyword';
//        $browser->doKeywordQuery($keyword);
    }
}