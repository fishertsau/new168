<?php
use Acme\Tool\Request\RequestService;

/**
 * @group tdd
 * @group service
 */
class RequestServiceTest extends TestCase
{
    private $requestService;

    protected function setUp()
    {
        parent::setUp();

        $this->requestService = new RequestService;
    }

    /** @test */
    function can_transpose_array_input()
    {
        $arrayInput = [
            'title' => ['冰箱', '咖啡機', '製冰機'],
            'description' => ['des1', 'des2', 'des3']
        ];

        $fields = ['title', 'description'];

        $transposedArray = $this->requestService->transposeArrayInput(
            $arrayInput, $fields);

        //assert
        $this->assertEquals($transposedArray, [
            ['title' => '冰箱', 'description' => 'des1'],
            ['title' => '咖啡機', 'description' => 'des2'],
            ['title' => '製冰機', 'description' => 'des3']
        ]);
    }
}
