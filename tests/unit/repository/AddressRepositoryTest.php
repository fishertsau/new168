<?php

use App\Models\Vendor;
use App\Repository\AddressRepository;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 */
class AddressRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $addRepo;

    protected function setUp()
    {
        parent::setUp();

        $this->addRepo = new AddressRepository;
    }


    /** @test */
    function could_save_model_addresses()
    {
        $model = factory(Vendor::class)->create();

        $addresses = collect([
            ['city' => 1, 'zip' => '100', 'street' => 'add1'],
            ['city' => 1, 'zip' => '103', 'street' => 'add2'],
            ['city' => 2, 'zip' => '233', 'street' => 'add3'],
        ]);

        //act
        $this->addRepo->saveModelAddress($model, $addresses);

        $modelAddresses = collect($model->addresses->toArray())->flatten(1);
        $this->assertCount($addresses->count(), $model->addresses);

        $addresses->every(function ($address, $key) use ($modelAddresses) {
            $this->assertTrue($modelAddresses->contains($address['city']));
            $this->assertTrue($modelAddresses->contains($address['zip']));
            $this->assertTrue($modelAddresses->contains($address['street']));
        });
    }
}
