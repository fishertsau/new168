<?php

use App\User;
use Acme\Tool\Ownable\Ownable;
use Acme\Tool\Discussionable\Models\Discussion;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class ModelOwnerTest
 * @group device
 * @group tdd
 */
class DiscussionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function is_ownable()
    {
        $d = App::make(Discussion::class);

        $this->assertTrue($d instanceof Ownable);
    }

    /** @test */
    function can_know_if_owned_by()
    {
        $this->disableExceptionHandling();

        $owner = factory(User::class)->create();
        $nonOwner = factory(User::class)->create();

        $d = factory(Discussion::class)->create([
            'user_id' => $owner->id,
        ]);

        $this->assertTrue($d->ownedBy($owner));
        $this->assertFalse($d->ownedBy($nonOwner));
    }
}
