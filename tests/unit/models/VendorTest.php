<?php


use App\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 */
class VendorTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_get_its_user()
    {
        $user = factory(User::class)->create();
        $vendor = factory(Vendor::class)->create([
            'user_id' => $user->id
        ]);

        $vendorUser = $vendor->user;

        $this->assertEquals($user->id, $vendorUser->id);
    }


    /** @test */
    function duplicate_user_is_disallowed()
    {
        $user = factory(User::class)->create();
        factory(Vendor::class)->create([
            'user_id' => $user->id
        ]);

        //create a new vendor
        $newVendor = $user->vendor()->create(['title' => 'hello']);

        $this->assertCount(1, $user->vendor()->get());
        $this->assertNull($newVendor->id);


        //create a new vendor
        $newVendor = factory(Vendor::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertCount(1, $user->vendor()->get());
        $this->assertNull($newVendor->id);
    }

    /** @test */
    function can_know_its_published_status()
    {
        $user = factory(User::class)->create();


        $vendor = factory(Vendor::class)->states('published')->create([
            'user_id' => $user->id
        ]);
        $this->assertTrue($vendor->published);


        $vendor = factory(Vendor::class)->states('unpublished')->create([
            'user_id' => $user->id
        ]);
        $this->assertFalse($vendor->published);
    }
}