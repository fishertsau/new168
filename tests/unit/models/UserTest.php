<?php

use App\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;


/**
 * @group tdd
 */
class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function verified_status_and_token_is_generated_when_account_creating()
    {
        $user = factory(User::class)->create();

        $this->assertNotNull($user->verified_token);
        $this->assertContains($user->verified, [true, false]);
    }


    /** @test */
    function can_get_verified_token_attribute()
    {
        $user = factory(User::class)->create();

        $this->assertEquals(30, strlen($user->verified_token));
    }

    /** @test */
    function can_generate_verified_token()
    {
        $user = factory(User::class)->create();

        $user->generateVerifiedToken()->save();

        $this->assertEquals(30, strlen($user->verified_token));
    }


    /** @test */
    function can_get_signIn_count()
    {
        $user = factory(User::class)->create(['signIn_count' => 15]);

        $this->assertSame(15, $user->signIn_count);
    }

    /** @test */
    function can_get_signIn_at()
    {
        $time = Carbon::now()->addDays(-1);
        $user = factory(User::class)->create(['signIn_at' => $time]);

        $this->assertEquals($time, $user->signIn_at);
    }

    /** @test */
    function can_get_last_signIn_at()
    {
        $time = Carbon::now()->addDays(-3);
        $user = factory(User::class)->create(['last_signIn_at' => $time]);

        $this->assertEquals($time, $user->last_signIn_at);
    }

    /** @test */
    function can_get_signIn_ip()
    {
        $user = factory(User::class)->create(['signIn_ip' => '100.100.100.100']);

        $this->assertEquals('100.100.100.100', $user->signIn_ip);
    }

    /** @test */
    function can_get_last_signIn_ip()
    {
        $user = factory(User::class)->create(['last_signIn_ip' => '100.100.100.100']);

        $this->assertEquals('100.100.100.100', $user->last_signIn_ip);
    }

    /** @test */
    function can_get_password()
    {
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);

        $this->assertTrue(Hash::check('secret', $user->password));
    }

    /** @test
     * @group vendor
     */
    function can_get_vendor()
    {
        $user = factory(User::class)->create();
        $vendor = factory(Vendor::class)->create(['user_id' => $user->id]);

        $this->assertEquals($user->vendor->id, $vendor->id);
        $this->assertNotNull($user->vendor);
    }


    /** @test
     * @group vendor
     */
    function get_null_if_vendor_is_not_created()
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->vendor);
    }

    /** @test
     * @group vendor
     */
    function can_create_vendor_through_relationship()
    {
        $user = factory(User::class)->create();
        $vendor = $user->vendor()->create(
            ['title' => 'Abc Vendor', 'type' => '個人']);

        $this->assertNotNull($user->vendor);
        $this->assertEquals($user->vendor->id, $vendor->id);
        $this->assertEquals($vendor->title, 'Abc Vendor');
    }

    /** @test
     * @group vendor
     */
    function can_create_at_most_one_vendor()
    {
        $user = factory(User::class)->create();
        $vendor = $user->vendor()->create(['title' => 'Abc Vendor', 'type' => '個人']);

        $this->assertNotNull($user->vendor);
        $this->assertEquals($user->vendor->id, $vendor->id);
        $this->assertEquals($vendor->title, 'Abc Vendor');
    }

    /** @test */
    function can_create_device_through_relationship()
    {
        $u = factory(User::class)->create();
        $device = $u->devices()->create(
            ['title' => 'Abc Device', 'cat_id' => 1]);

        $this->assertCount(1, $u->devices);
        $this->assertEquals($u->devices->first()->id, $device->id);
        $this->assertEquals($u->devices->first()->title, 'Abc Device');
    }

    /** @test */
    function cannot_see_user_info_when_queried()
    {
        $u = factory(User::class)->create();

        $this->assertArrayNotHasKey('id', $u->fresh()->toArray());
        $this->assertArrayNotHasKey('password', $u->fresh()->toArray());
        $this->assertArrayNotHasKey('verified_token', $u->fresh()->toArray());
        $this->assertArrayNotHasKey('remember_token', $u->fresh()->toArray());
        $this->assertArrayNotHasKey('created_at', $u->fresh()->toArray());
        $this->assertArrayNotHasKey('updated_at', $u->fresh()->toArray());
    }
}
