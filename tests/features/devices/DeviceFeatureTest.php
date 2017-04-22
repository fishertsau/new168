<?php

use App\User;
use App\Models\Occasion;
use App\Models\Device\Device;
use Illuminate\Foundation\Testing\DatabaseMigrations;


/**
 * Class DeviceFeatureTest
 * @group device
 * @group tdd
 */
class DeviceFeatureTest extends TestCase
{
    use DatabaseMigrations;

    use AssertDeviceCRUD;

    //Device Creation
    /** @test */
    function a_signIn_verified_user_can_create_device()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);

        $response = $this->json('post', route('devices.store'), [
            'cat_id' => 1,
            'title' => 'A jack pot vendor'
        ]);

        $device = Device::first();

        $response->assertStatus(302)
            ->assertRedirect(route('devices.edit', $device->id));
        $this->assertEquals($user->id, $device->user->id);

        //default setting
        $this->AssertDeviceDefault($device);
    }

    /** @test */
    function redirect_to_login_if_unsignIn_user_try_to_create_a_device()
    {
        $response = $this->get(route('devices.create'));

        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }


    //Device CRUD
    /** @test */
    function an_account_can_edit_a_device()
    {

        $u = factory(User::class)->states('verified')->create();
        $device = factory(Device::class)
            ->states('published')->create(['user_id' => $u->id]);
        $this->actingAs($u);

        $response = $this->get(route('devices.edit', $device->id));

        $response->assertStatus(200);
    }

    /** @test */
    function an_signIn_verified_user_can_update_device()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);
        $device = $user->devices()->create(['cat_id' => 1, 'title' => 't1']);

        $input = [
            //control
            'published' => true,

            //basic info
            'cat_id' => 100,
            'title' => 'A new vendor name',
            'brand' => '一般品牌',
            'model' => 'model',

            //business term
            'price' => 500,
            'price_note' => 'price_note',
            'transaction' => 'transaction',
            'deposit' => 300,

            'transportation' => 'transportation',
            'freight' => 500,

            //device status
            'is_new' => true,
            'used_time' => 'used_time',

            //contact info
            'contact_tel' => '123',
            'contact_role' => '555',
            'contact_email' => 'john@example.com',
            'contact_name' => 'John Doe',
            'contact_line_id' => 'lineId123',

            //description
            'description' => 'Device description',

            //condition & guarantee
            'used_condition' => 'Used Condition',
            'guarantee' => 'guarantee',

            //spec + frequent use specs
            'gas_type' => 'gas_type',
            'voltage' => 'voltage',
            'dimension' =>
                [
                    'width' => 1,
                    'height' => 1,
                    'depth' => 2
                ],

            //locations
            'city' => 10,
            'zip' => 250,
            'street' => 'street',
        ];

        $response = $this->put(route('devices.update', $device->id),
            $input);

        $device = $device->fresh();

        $response->assertStatus(302)
            ->assertRedirect(route('devices.show', $device->id));

        //control
        $this->assertEquals($device->published, $input['published']);

        //basic info
        $this->assertEquals($device->cat_id, $input['cat_id']);
        $this->assertSame($device->title, $input['title']);
        $this->assertSame($device->brand, $input['brand']);
        $this->assertSame($device->model, $input['model']);


        //business term
        $this->assertEquals($device->price, $input['price']);
        $this->assertSame($device->price_note, $input['price_note']);
        $this->assertSame($device->transaction, $input['transaction']);
        $this->assertEquals($device->deposit, $input['deposit']);
        $this->assertSame($device->transportation, $input['transportation']);
        $this->assertEquals($device->freight, $input['freight']);

        //device status
        $this->assertEquals($device->is_new, $input['is_new']);
        $this->assertEquals($device->used_time, $input['used_time']);


        //contact info
        $this->assertSame($device->contact_tel, $input['contact_tel']);
        $this->assertSame($device->contact_role, $input['contact_role']);
        $this->assertSame($device->contact_email, $input['contact_email']);
        $this->assertSame($device->contact_name, $input['contact_name']);
        $this->assertSame($device->contact_line_id, $input['contact_line_id']);

        //introduction
        $this->assertSame($device->description, $input['description']);

        //condition & guarantee
        $this->assertSame($device->used_condition, $input['used_condition']);
        $this->assertSame($device->guarantee, $input['guarantee']);

        //spec + frequent use specs
        $this->assertSame($device->gas_type, $input['gas_type']);
        $this->assertSame($device->voltage, $input['voltage']);
        $this->assertSame($device->dimension, $input['dimension']);


        //location
        $this->assertEquals($device->city, $input['city']);
        $this->assertEquals($device->zip, $input['zip']);
        $this->assertEquals($device->street, $input['street']);
    }

    /** @test */
    function an_account_can_delete_a_device()
    {
        //arrange
        $u = factory(User::class)->states('verified')->create();
        $device = factory(Device::class)->create(['user_id' => $u->id]);
        $this->actingAs($u);
        $this->assertNotNull($device->fresh());

        //act
        $response = $this->delete(route('devices.destroy', $device->id));

        //assert
        $response->assertStatus(302)
            ->assertRedirect(route('account'));

        $this->assertNull($device->fresh());
    }

    /** @test */
    function non_owner_is_not_allowed_to_edit_update_or_delete()
    {
        //arrange
        $u = factory(User::class)->states('verified')->create();
        $device = factory(Device::class)->create([
            'user_id' => $u->id, 'title' => 'A title'
        ]);
        $this->assertNotNull($device);

        $this->actingAs($newU = factory(User::class)->states('verified')->create());

        //edit
        $response = $this->get(route('devices.edit', $device->id));
        $response->assertStatus(302)
            ->assertRedirect(route('home'));

        //update
        $response = $this->post(route('devices.update', $device->id), [
            'title' => 'A new title'
        ]);
        $response->assertStatus(405);
        $this->assertEquals('A title', $device->fresh()->title);

        //delete
        //act
        $response = $this->delete(route('devices.destroy', $device->id));

        //assert
        $response->assertStatus(302);
        $this->assertNotNull($device->fresh());
    }

    /** @test */
    function unverified_account_is_not_allowed_to_delete_edit_or_update_a_device()
    {
        //arrange
        $u = factory(User::class)->states('unverified')->create();
        $device = factory(Device::class)->create([
            'user_id' => $u->id,
            'title' => 'A title'
        ]);
        $this->actingAs($u);

        //edit
        $response = $this->get(route('devices.edit', $device->id));
        $response->assertStatus(302)
            ->assertRedirect(route('account'));

        //update
        $response = $this->patch(route('devices.update', $device->id), [
            'title' => 'A new title'
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('account'));

        $this->assertEquals('A title', $device->fresh()->title);

        //delete
        $response = $this->delete(route('devices.destroy', $device->id));

        //assert
        $response->assertStatus(302)
            ->assertRedirect(route('account'));

        $this->assertNotNull($device->fresh());
    }


    /** @test */
    function redirect_to_login_when_unsigned_user_try_to_crud_a_device()
    {
        $u = factory(User::class)->states('verified')->create();
        $device = factory(Device::class)->create([
            'user_id' => $u->id, 'title' => 'A title'
        ]);

        //create
        $response = $this->get(route('devices.create'));
        $response->assertStatus(302)
            ->assertRedirect(route('login'));

        //edit
        $response = $this->get(route('devices.edit', $device->id));
        $response->assertStatus(302)
            ->assertRedirect(route('login'));


        //update
        $response = $this->patch(route('devices.update', $device->id), ['title' => 'A new title']);
        $response->assertStatus(302)
            ->assertRedirect(route('login'));


        //delete
        $response = $this->delete(route('devices.destroy', $device->id));

        //assert
        $response->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertNotNull($device->fresh());
    }



    //device query
    /** @test */
    function devices_could_be_queried_by_queryTerm_from_frontend()
    {
        factory(User::class)->create();
        factory(Device::class, 30)->states('published')->create();
        factory(Device::class, 5)->states('published')->create(['title' => '冰箱']);

        //query by keyword
        $queryResult = $this->json('post', 'api/devices/list/paginated',
            ['queryTerm' =>
                ['keyword' => '冰箱']
            ]);

        $this->assertCount(5, $queryResult->json()['data']);
    }

    /** @test */
    function devices_could_be_queried_without_queryTerm()
    {
        factory(User::class)->create();
        factory(Device::class, 5)->states('published')->create(['title' => '冰箱']);

        //query by keyword
        $queryResult = $this->json('post', 'api/devices/list/paginated');

        $this->assertCount(5, $queryResult->json()['data']);
    }

    /** @test */
    function only_published_devices_could_be_queried_from_the_frontend()
    {
        factory(Device::class, 3)->states('published')->create(['title' => '超級無敵冰箱']);
        factory(Device::class, 5)->states('unpublished')->create(['title' => '超級無敵冰箱']);

        //query by keyword
        $queryResult = $this->json('post',
            'api/devices/list/paginated',
            ['queryTerm' =>
                ['keyword' => '冰箱']
            ]);

        $this->assertCount(3, $queryResult->json()['data']);
    }

    /** @test */
    function devices_could_be_queried_from_admin_for_any_publish_status()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->signInUser($user);

        factory(Device::class, 3)->states('published')->create(['title' => '超級無敵冰箱']);
        factory(Device::class, 5)->states('unpublished')->create(['title' => '超級無敵冰箱']);

        //query by keyword
        $queryResult = $this->json('post', 'api/admin/devices/list/paginated',
            ['queryTerm' =>
                ['keyword' => '冰箱']
            ]);

        $this->assertCount(8, $queryResult->json()['data']);
    }

    /** @test */
    function user_can_choose_query_page_number()
    {
        //arrange
        factory(Device::class, 50)->states('published')->create(['title' => '冰箱']);

        //act + assert
        $response = $this->json('post', 'api/devices/list/paginated',
            ['queryTerm' =>
                ['keyword' => '冰箱']
            ]);

        $this->assertEquals(1, $response->json()['current_page']);

        //act + assert
        $response = $this->json('post', 'api/devices/list/paginated?page=2',
            ['queryTerm' =>
                ['keyword' => '冰箱']
            ]);
        $this->assertEquals(2, $response->json()['current_page']);
    }

//
//    /** @test */
    //redirect to login page when un-signIn user try to like a device
//    function an_user_can_toggleLike_a_device()
//    {
//
//    }
//
//    /** @test */
//    function only_authorized_user_can_togglePublish_a_device()
//    {
//
//    }
//
//
//    /** @test */
    //redirect to login page, when an un-signIn user tries to raise discussion
//    function an_authenticated_user_can_raiseDiscussion_on_a_device()
//    {
//
//    }
//
//
//    /** @test */
//    function an_authenticated_user_can_cease_self_owned_discussion()
//    {
//
//    }
//
//    /** @test */
    //redirect to login page, when an un-signIn user tries to join discussion
//    function an_authenticated_user_can_join_a_discussion()
//    {
//
//    }
//
//    /** @test */
//    function an_authenticated_user_can_delete_a_dialogue_in_a_discussion()
//    {
//
//    }


    //Show
    /** @test */
    function can_see_device_info()
    {
        $device = factory(Device::class)->states('published')->create();

        $response = $this->get(route('devices.show', $device->id));

        $response->assertStatus(200);
    }

    /** @test */
    function cannot_see_unpublished_device_from_frontend()
    {
        $device = factory(Device::class)->states('unpublished')->create();

        $response = $this->get(route('devices.show', $device->id));

        $response->assertStatus(302)
            ->assertRedirect(route('devices.index'));
    }

    /** @test */
    function owner_can_see_unpublished_device_from_the_frontend()
    {
        $u = factory(User::class)->create();
        $device = factory(Device::class)
            ->states('unpublished')->create(['user_id' => $u->id]);

        $this->actingAs($u);

        $response = $this->get(route('devices.show', $device->id));

        $response->assertStatus(200);
    }

    /** @test */
    function read_count_is_incremented_by_one_for_each_visit()
    {
        $device = factory(Device::class)->states('published')->create();
        $reads = $device->reads;

        $response = $this->get(route('devices.show', $device->id));

        $response->assertStatus(200);
        $this->assertEquals($reads + 1, $device->fresh()->reads);
    }

    /** @test */
    function can_syncUp_occasion()
    {
        factory(Occasion::class, 10)->create();
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);
        $device = $user->devices()->create(['cat_id' => 1, 'title' => 't1']);

        $input = [
            'occasion' => [1, 2, 4, 6],
        ];

        $response = $this->put(route('devices.update', $device->id),
            $input);

        $device = $device->fresh();

        $response->assertStatus(302)
            ->assertRedirect(route('devices.show', $device->id));

        $this->assertEquals($input['occasion'], mapAttribute($device->fresh()->occasions, 'id'));
    }

    /** @test */
    function can_update_spec()
    {
        $user = factory(User::class)->states('verified')->create();
        $this->actingAs($user);
        $device = $user->devices()->create(['cat_id' => 1, 'title' => 't1']);

        $input = [
            'specs' => [
                'title' => ['重量', '瓦數', '製冰機'],
                'description' => ['100kg', '100W', 'des3']
            ],
        ];

        $response = $this->put(route('devices.update', $device->id),
            $input);

        $device = $device->fresh();

        $response->assertStatus(302)
            ->assertRedirect(route('devices.show', $device->id));


        $specs = [
            ['title' => '重量', 'description' => '100kg'],
            ['title' => '瓦數', 'description' => '100W'],
            ['title' => '製冰機', 'description' => 'des3']
        ];

        $this->assertEquals($specs, $device->specs);
    }
}

