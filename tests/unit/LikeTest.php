<?php

use App\Models\Device\Device;

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class LikeTest
 */
class LikeTest extends TestCase
{
    use DatabaseTransactions;

    protected $device;
    protected $deviceSetting = ['title' => 'title', 'cat_id' => 1];

    function setUp()
    {
        parent::setUp();
        $this->signInUser();
        $device = new Device($this->deviceSetting);
        $this->device = $this->user->devices()->save($device);
    }


    /** @test */
    function an_user_can_like_a_device()
    {
        $this->device->like();

        $this->seeInDatabase('likes',
            ['user_id' => $this->user->id,
                'likeable_id' => $this->device->id,
                'likeable_type' => get_class($this->device)]);

        $this->assertTrue($this->device->isLiked());
    }

    /** @test */
    function an_user_can_unlike_a_device()
    {
        $this->device->like();
        $this->device->unLike();

        $this->notSeeInDatabase('likes',
            ['user_id' => $this->user->id,
                'likeable_id' => $this->device->id,
                'likeable_type' => get_class($this->device)]);

        $this->assertFalse($this->device->isLiked(), 'The device should not be like anymore');
    }

    /** @test */
    function an_user_can_toggle_a_device()
    {
        $this->device->toggleLike();
        $this->assertTrue($this->device->isLiked());

        $this->device->toggleLike();
        $this->assertFalse($this->device->isLiked());
    }

    /** @test */
    function a_device_knows_how_many_likes_it_has()
    {
        $this->device->toggleLike();

        $this->assertEquals(1, $this->device->likesCount);

        $this->device->toggleLike();

        $this->assertEquals(0, $this->device->likesCount);
    }
}
