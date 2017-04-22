<?php

use App\Models\Vendor;
use App\Repository\ProductRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 */
class ProductRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $proRepo;

    protected function setUp()
    {
        parent::setUp();

        $this->proRepo = new ProductRepository;
    }


    /** @test */
    function could_save_model_products()
    {
        $model = factory(Vendor::class)->create();

        $products = collect([
            ['title' => 'ProA', 'description' => 'Des1'],
            ['title' => 'ProB', 'description' => 'Des2']
        ]);

        //act
        $this->proRepo->saveModelProduct($model, $products);


        $modelProducts = collect($model->products->toArray())->flatten(1);
        $this->assertCount($products->count(), $model->products);

        $products->every(function ($product, $key) use ($modelProducts) {
            $this->assertTrue($modelProducts->contains($product['title']));
            $this->assertTrue($modelProducts->contains($product['description']));
        });
    }
}
