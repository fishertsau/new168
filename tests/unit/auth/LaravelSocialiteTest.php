<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;


/**
 * @group tdd
 * @group integration
 *
 * */
class LaravelSocialiteTest extends TestCase
{
    use DatabaseTransactions;

    private $laravelSocialiteGateway;

    protected function setUp()
    {
        parent::setUp();
        $this->laravelSocialiteGateway = new \Acme\Auth\LaravelSocialiteGateway;
    }


    /** @test */
    function can_register_an_account_with_FB_account()
    {
        //act
        $this->json('get', '/auth/socialite/facebook');

        // assert
    }


    /** @test */
    function a_registered_user_can_login_with_FB_account()
    {
        //arrange


        //act


        //assert

    }
}
