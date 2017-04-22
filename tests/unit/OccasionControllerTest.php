<?php

use App\Http\Controllers\Admin\Device\OccasionsController;
use App\Models\Occasion;


use Illuminate\Foundation\Testing\DatabaseTransactions;

class OccasionControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $controller;

    public function setUp()
    {
        parent::setUp();
        session()->flush();
        $this->controller = new OccasionsController;
    }


    /** @test */
    public function the_query_term_could_be_updated()
    {
        $occasionQueryTerm = [
            'keyword_by' => 'title123',
            'keyword' => '麵',
            'active' => false
        ];

        $this->controller->getList(mockRequest($occasionQueryTerm));

        $this->assertEquals(
            $occasionQueryTerm, session('occasionQueryTerm'),
            "The occasion query term is expected to be same as the new input.");
    }


    /** @test */
    function can_make_query_basing_upon_query_term()
    {
        //arrange
        for ($i = 1; $i <= 23; $i++) {
            factory(Occasion::class)->create(['title' => '麵_' . $i]);
        }

        for ($i = 1; $i <= 46; $i++) {
            factory(Occasion::class)->create(['title' => '店_' . $i]);
        }

        $this->assertEquals(69, Occasion::all()->count());


        //keyword by title
        $queryInput = [
            'keyword_by' => 'title',
            'keyword' => '麵',
            'active' => true
        ];

        $occasionsKeyWordByTitle = $this->controller->getList(mockRequest($queryInput));
        $this->assertCount(23, $occasionsKeyWordByTitle);

        $occasionsKeyWordByTitle_withPagination = $this->controller->getList(mockRequest($queryInput), true);
        $this->assertCount(10, $occasionsKeyWordByTitle_withPagination);
    }
}
