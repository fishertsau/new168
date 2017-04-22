<?php

use App\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class VendorFeatureTest
 * @group tdd
 * @group vendor
 */
class VendorFeatureTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_signedIn_verified_user_can_create_vendor()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);

        $response = $this->json('post', 'vendors', [
            'type' => '個人',
            'title' => 'A jack pot vendor'
        ]);

        $vendor = Vendor::first();

        $response->assertStatus(302)
            ->assertRedirect('vendors/' . $vendor->id . "/edit");
        $this->assertEquals($user->id, $vendor->user->id);
    }


    /** @test */
    function an_account_can_create_at_most_one_vendor()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);
        $vendor = factory(Vendor::class)->create(['title' => 'a vendor', 'user_id' => $user->id]);

        //create
        $response = $this->get('vendors/create');
        $response->assertStatus(302)
            ->assertRedirect('vendors/' . $vendor->id . "/edit");
        $this->assertCount(1, Vendor::where('user_id', $user->id)->get());

        //store
        $response = $this->json('post', 'vendors', [
            'title' => 'A jack pot vendor'
        ]);

        $response->assertStatus(302)
            ->assertRedirect('vendors/' . $vendor->id . "/edit");
        $this->assertCount(1, Vendor::where('user_id', $user->id)->get());
        $this->assertEquals($vendor->fresh()->title, 'A jack pot vendor');
    }


    /** @test */
    function unVerified_user_is_disallowed_to_create_vendor()
    {
        $user = factory(User::class)->states('unverified')->create();
        $this->actingAs($user);

        //create
        $response = $this->get('vendors/create');

        $response->assertStatus(302)
            ->assertRedirect('account');


        //store
        $response = $this->json('post', 'vendors', [
            'title' => 'A jack pot vendor'
        ]);

        $response->assertStatus(302)
            ->assertRedirect('account');
        $this->assertNull($user->fresh()->vendor);
    }


    /** @test */
    function unSignedIn_user_is_not_allowed_to_create_vendor()
    {
        //create
        $response = $this->get('vendors/create');

        $response->assertStatus(302)
            ->assertRedirect('login');

        //store
        $response = $this->post('vendors', [
            'title' => 'A jack pot vendor'
        ]);

        $response->assertStatus(302)
            ->assertRedirect('login');
        $this->assertCount(0, Vendor::all());
    }

    /** @test */
    function an_unSignedIn_user_is_not_allowed_to_update()
    {
        //create
        //it is decided not to test this function.
    }

    /** @test */
    function an_unVerified_user_is_not_allowed_to_update()
    {
        $user = factory(User::class)->states('unverified')->create();
        $this->actingAs($user);
        $vendor = factory(Vendor::class)->create(['user_id' => $user->id]);

        $response = $this->json('put', route('vendors.update', $vendor->id), [
            'title' => 'Crazy vendor'
        ]);

        $response->assertStatus(302)
            ->assertRedirect('account');
    }


    /** @test */
    function vendor_could_not_be_seen_from_frontend_if_unpublished()
    {
        $user = factory(User::class)->states('verified')->create();
        $vendor = factory(Vendor::class)->states('unpublished')->create(['user_id' => $user->id]);


        $response = $this->get(route('vendors.show', $vendor->id));

        $response->assertStatus(302)
            ->assertRedirect(route('vendors.index'));
    }


    /** @test */
    function redirect_if_no_vendor_found()
    {
        $vendorCount = Vendor::all()->count();

        $response = $this->get(route('vendors.show', $vendorCount + 1));

        $response->assertStatus(302)
            ->assertRedirect(route('vendors.index'));
    }

    /** @test */
    function owner_can_see_its_unpublished_vendor()
    {
        $user = factory(User::class)->states('verified')->create();
        $vendor = factory(Vendor::class)->states('unpublished')
            ->create(['user_id' => $user->id, 'title' => 'a crazy vendor']);

        $this->actingAs($user);

        $response = $this->get(route('vendors.show', $vendor->id));

        $response->assertStatus(200);
    }


    /** @test */
    function could_not_be_seen_if_account_is_not_verified()
    {
        $user = factory(User::class)->states('unverified')->create();
        $vendor = factory(Vendor::class)->states('published')->create(['user_id' => $user->id]);

        $response = $this->get(route('vendors.show', $vendor->id));

        $response->assertStatus(302)
            ->assertRedirect(route('vendors.index'));
    }


    /** @test */
    function each_vendor_has_unique_serial_number()
    {
//        $vendorNum = random_int(1, 100);
//        $input = fakeRequest($this->vendorInput);
//
//        for ($i = 0; $i < $vendorNum; $i++) {
//            $user = factory('App\User')->create();
//            Auth::login($user);
//            $this->vendorService->create($input);
//        }
//
//        $sns = DB::table(self::tableName)->pluck('sn');
//        $this->assertCount($vendorNum, $sns, "There should be $vendorNum sns.");
    }


    /** @test */
    function an_signIn_verified_user_can_update_vendor()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);
        $vendor = factory(Vendor::class)->create([
            'title' => 'a vendor',
            'type' => '個人'
        ]);

        $input = [
            //control
            'published' => true,

            //basic info
            'type' => '公司',  //個人 行號  公司
            //vendor category //vendor category id, predefined
            'title' => 'A new vendor name',

            //contact info
            'telephone' => '123',
            'fax' => '555',
            'url' => 'www.company.com',
            'fbUrl' => 'www.facebook.hello',
            'email' => 'john@example.com',
            'contact' => 'John Doe',

            //description
            'description' => 'Company description',

            //maintenance
            'could_maintain' => true,
            'maintenance_items' => ['冰箱', '咖啡機', '製冰機'],

            //products
            'products' => [
                'title' => ['冰箱', '咖啡機', '製冰機'],
                'description' => ['des1', 'des2', 'des3']
            ],

            //locations
            'addresses' => [
                'city' => [1, 5],
                'zip' => [2, 250],
                'street' => ['street1', 'street2']
            ],

            //services
            'services' => [
                ['title' => ['冰箱清洗', '設備維修', '食材供應']],
                ['content' => ['content1', 'content2', 'content3']]
            ],
            'service_areas' => ['台中市', '台南市', '彰化縣'],
            'service_time' => '星期一~星期六AM08：00 ~ PM17：30',

//            //photos
//            //main photo
//            //introduction photos
//
//
//            //公司登記資料
//            //統一編號
//            //營業登記證
//            //工商憑證
        ];


        $response = $this->put(route('vendors.update', $vendor->id),
            $input);

        $vendor = $vendor->fresh();

        $response->assertStatus(302)
            ->assertRedirect(route('vendors.show', $vendor->id));

        //control
        $this->assertSame($vendor->published, $input['published']);

        //basic info
        $this->assertSame($vendor->type, $input['type']);
//        $this->assertSame($vendor->cat_id, $input['cat_id']);
        $this->assertSame($vendor->title, $input['title']);


        //contact info
        $this->assertSame($vendor->telephone, $input['telephone']);
        $this->assertSame($vendor->fax, $input['fax']);
        $this->assertSame($vendor->url, $input['url']);
        $this->assertSame($vendor->fbUrl, $input['fbUrl']);
        $this->assertSame($vendor->email, $input['email']);
        $this->assertSame($vendor->contact, $input['contact']);

        //introduction
        $this->assertSame($vendor->description, $input['description']);


        //maintenance
        $this->assertSame($vendor->could_maintain, $input['could_maintain']);
        $this->assertEquals($vendor->maintenance_items, $input['maintenance_items']);

        //products
        $this->assertCorrectProduct($input, $vendor);

        //addresses
        $this->assertCorrectAddress($input, $vendor);

//        //services
        $this->assertEquals($vendor->services, $input['services']);
        $this->assertEquals($vendor->service_areas, $input['service_areas']);
        $this->assertSame($vendor->service_time, $input['service_time']);
    }



    //update validation

    /** @test */
    function vendor_address_could_be_updated()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);
        $vendor = factory(Vendor::class)->create(['user_id' => $user->id]);

        $input = [
            'addresses' => [
                'city' => [1, 5],
                'zip' => [2, 250],
                'street' => ['street1', 'street2']
            ]];

        $this->put(route('vendors.update', $vendor->id),
            $input);
        $this->assertCorrectAddress($input, $vendor->fresh());

        //act
        $newInput = [
            'addresses' => [
                'city' => [1, 2, 3],
                'zip' => [2, 249, 201],
                'street' => ['street1', 'street3', 'Adam Street']
            ]
        ];

        $this->put(route('vendors.update', $vendor->id),
            $newInput);

        //assert
        $this->assertCorrectAddress($newInput, $vendor->fresh());
    }

    /** @test */
    function vendor_products_could_be_updated()
    {
        $this->disableExceptionHandling();

        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);
        $vendor = factory(Vendor::class)->create(['user_id' => $user->id]);

        $input = [
            'products' => [
                'title' => ['冰箱', '咖啡機', '製冰機'],
                'description' => ['des1', 'des2', 'des3']]
        ];

        $this->put(route('vendors.update', $vendor->id),
            $input);
        $this->assertCorrectProduct($input, $vendor->fresh());

        //act
        $newInput = [
            'products' => [
                'title' => ['冰箱', '製冰機', '水箱', '木箱'],
                'description' => ['des1', 'des3', 'des2', 'wood']]
        ];

        $this->put(route('vendors.update', $vendor->id),
            $newInput);

        //assert
        $this->assertCorrectProduct($newInput, $vendor->fresh());
    }





    /*** Admin authority*/
    /** @test */
    function the_authorized_system_users_could_do_any_change_to_a_vendor_from_admin()
    {

    }


    /** @test */
    function the_authorized_system_users_can_activate_and_deactivate_a_vendor_from_admin()
    {

    }



    /**** Like and Dislike ******/
    /** @test */
    function the_auth_user_could_frequent_or_unFrequent_a_vendor()
    {
        //given
//        $vendor = $this->createUserCompany($this->user, $this->vendorInput);
//
//        //when
//        $vendor->like();
//
//        $this->seeInDatabase('likes',
//            ['user_id' => $this->user->id,
//                'likeable_id' => $vendor->id,
//                'likeable_type' => get_class($vendor)]);
//
//        $this->assertTrue($vendor->isLiked());
//
//        $vendor->unLike();
//        $this->assertFalse($vendor->isLiked());
    }


    /** @test */
    function a_vendor_could_know_its_frequent_count()
    {

    }


    /** @test */
    function a_vendor_could_know_its_frequent_followers()
    {

    }


    /** @test */
    function each_vendor_product_could_upload_its_cover_photo()
    {

    }


    /** @test */
    function a_product_photo_is_removed_when_the_product_is_removed()
    {

    }


    /** @test */
    function a_vendor_could_not_be_deleted()
    {
        // Test code
        //arrange


        //act


        //assert


    }


    /** @test */
    function a_vendor_can_update_service_content()
    {

    }

    /** @test */
    function a_vendor_can_remove_services_it_owns()
    {

    }

    /** @test */
    function vendor_services_are_removed_when_the_vendor_is_deleted()
    {

    }



    /*** Contacts ***/
    /** @test */
    function a_vendor_can_specify_arbitrary_number_of_contacts()
    {
        //given a vendor
        //when contract
    }


    /** @test */
    function a_vendor_can_remove_contacts()
    {

    }



    /** Address*/
    /** @test */
    function an_signIn_verified_user_can_update_vendor_addresses()
    {

    }


    /** Verified  and Deactivate*/
    /** @test */
    function a_vendor_is_verified_when_required_information_is_provided()
    {
        //given
//        $vendor = $this->createUserCompany(null, $this->vendorInput);
//        $this->assertFalse($vendor->verified);
//
//        //when
//        $vendor->update($this->verifiedRequiredInformation);
//
//        //then
//        $this->assertTrue($vendor->verified);
    }


    /** @test */
    function a_vendor_become_unVerified_when_required_information_is_deleted()
    {
        //given
//        $vendor = $this->createUserCompany(null, $this->vendorInput);
//        $vendor->update($this->verifiedRequiredInformation);
//
//        //when
//        $vendor->update(['tax_no' => '']);
//
//        //then
//        $this->assertFalse($vendor->verified);
    }




    /** Device vendor maintenance*/
    /** @test */
    function a_device_vendor_can_specify_whether_it_provides_maintenance_service()
    {

    }


    /** @test */
    function a_device_vendor_can_specify_device_types_that_it_can_maintain()
    {

    }




    /****Photo uploads ******************/
    /** @test */
    function a_vendor_could_upload_its_coverPhoto()
    {
        //given
//        $vendor = $this->createUserCompany(null, $this->vendorInput);
//        $uploadedFile = fakeUploadedFile();
//        $fieldName = 'coverPhoto';
//
//        //when
//        $photo = $this->photoRepository->storeOrUpdate(
//            $uploadedFile,
//            $vendor,
//            $fieldName);
//
//        //then
//        $expectedResult = [
//            'photoable_id' => $vendor->id,
//            'photoable_type' => get_class($vendor),
//            'filepath' => $photo->filepath,
//            'field' => $fieldName
//        ];
//
//        // the photo entry is seen in the database
//        $this->seeInDatabase('photos', $expectedResult);
//        $this->assertFileExists($this->storagePath($photo->filepath));
//
//        $this->restorePhotoFileToOriginalPlace($photo->filepath);
    }

    /** @test */
    function a_vendor_can_upload_at_most_12_photos_for_introduction()
    {
        //given
        //a vendor is created

        //when more than 12 photos are uploaded

        //then we see exceptions, and the 10 photos in database and files
    }

    /**
     * @param $input
     * @param $vendor
     */
    private function assertCorrectAddress($input, $vendor)
    {
        $addresses = collect($input['addresses']);
        $addressInputQty = collect($addresses['city'])->count();
        $this->assertCount($addressInputQty, $vendor->addresses);
        $vendorSites = collect($vendor->addresses->toArray())->flatten(1);

        for ($i = 0; $i < $vendor->addresses->count(); $i++) {
            $this->assertTrue($vendorSites->contains($addresses['city'][$i]));
            $this->assertTrue($vendorSites->contains($addresses['zip'][$i]));
            $this->assertTrue($vendorSites->contains($addresses['street'][$i]));
        }
    }

    /**
     * @param $input
     * @param $vendor
     */
    private function assertCorrectProduct($input, $vendor)
    {
        $products = collect($input['products']);
        $productInputQty = collect($products['title'])->count();

        $this->assertCount($productInputQty, $vendor->products);
        $vendorProducts = collect($vendor->products->toArray())->flatten(1);

        for ($i = 0; $i < $products->count(); $i++) {
            $vendorProducts->contains($products['title'][$i]);
            $vendorProducts->contains($products['description'][$i]);
        }
    }






    //query
//    /** @test */
//    function device_companies_could_be_queried_with_location()
//    {
//
//    }
//
//
//    /** @test */
//    function device_companies_could_be_queried_with_maintenance_capability()
//    {
//
//    }


}
