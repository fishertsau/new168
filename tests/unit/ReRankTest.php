<?php

use App\Http\Controllers\Admin\Device\OccasionsController;
use App\Models\Occasion;


use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ReRankTest
 * This class can help to re-rank a designated model
 *
 *  Normally, only a short list is recommend to use this class.
 *
 *  Requirement:   The model should have 'rank' field, and ranked with unique rank, e.g. 1,2...n.
 *
 *  Usage example:  (new Ranker(Occasion::class, $rank))->handle( 'up');
 *
 *  Designated Model: Model name
 *  Target Rank for the chosen item: $rank
 * Four actions:  (1)top, (2)up, (3)down, (4)bottom
 *
 *
 */
class ReRankTest extends TestCase
{
    use DatabaseTransactions;

    protected $occasions;
    protected $controller;

    const first = 1;
    const last = 15;

    /** @before */
    function setUpItems()
    {
        factory(Occasion::class, self::last)->create();

        $this->occasions = Occasion::oldest('rank')->get();
        $this->controller = new OccasionsController;
    }


    /** @test */
    function items_are_successfully_created()
    {
        $this->assertCount(self::last, $this->occasions);
    }


    /** @test */
    function no_any_rank_is_changed_when_rankOne_item_is_moved_to_top_or_up()
    {
        //when moved to top
        $requestInput = [
            'rankAction' => 'top'
        ];

        $this->controller->reRank(self::first, mockRequest($requestInput));

        //then
        $this->assert_original_and_new_list_is_same();

        //when moved up
        $requestInput = [
            'rankAction' => 'up'
        ];

        $this->controller->reRank(self::first, mockRequest($requestInput));

        //then
        $this->assert_original_and_new_list_is_same();
    }


    /** @test */
    function no_any_rank_is_changed_when_rankLast_item_is_moved_to_bottom_or_down()
    {
        //when
        $requestInput = [
            'rankAction' => 'bottom'
        ];

        $this->controller->reRank(self::last, mockRequest($requestInput));

        //then
        $this->assert_original_and_new_list_is_same();

        //when moved down
        $requestInput = [
            'rankAction' => 'down'
        ];

        $this->controller->reRank(self::last, mockRequest($requestInput));

        //then
        $this->assert_original_and_new_list_is_same();
    }


    /** @test */
    function an_item_has_rank_1_when_move_to_top()
    {
        //given
        $targetRank = random_int(self::first + 1, self::last);

        //when
        $item = Occasion::whereRank($targetRank)->first();

        $requestInput = [
            'rankAction' => 'top'
        ];
        $this->controller->reRank($targetRank, mockRequest($requestInput));

        //then
        $newItem = Occasion::whereRank(self::first)->first();
        $this->hasSameTitle($item->title, $newItem->title);


        $this->assert_original_and_new_list_within_a_range_is_same($targetRank + 1, self::last);
        $this->assert_each_item_in_upper_part_is_incremented_by_one($targetRank);
    }


    /** @test */
    function an_item_rank_is_decremented_by_one_when_move_up()
    {
        //given
        $targetRank = random_int(self::first + 1, self::last);
        $targetRankPrevious = $targetRank - 1;

        $item = Occasion::whereRank($targetRank)->first();
        $itemBefore = Occasion::whereRank($targetRankPrevious)->first();

        //when
        $requestInput = [
            'rankAction' => 'up'
        ];
        $this->controller->reRank($targetRank, mockRequest($requestInput));


        //then  titles were swapped
        $newItem = Occasion::whereRank($targetRankPrevious)->first();
        $this->hasSameTitle($item->title, $newItem->title);


        $newItemBefore = Occasion::whereRank($targetRank)->first();
        $this->hasSameTitle($itemBefore->title, $newItemBefore->title);

        $this->assert_original_and_new_list_within_a_range_is_same(self::first, $targetRank - 2);
        $this->assert_original_and_new_list_within_a_range_is_same($targetRank + 1, self::last);
    }


    /** @test */
    function an_item_has_rank_last_when_move_to_bottom()
    {
        //given
        $targetRank = random_int(self::first, self::last - 1);

        //when
        $item = Occasion::whereRank($targetRank)->first();

        $requestInput = [
            'rankAction' => 'bottom'
        ];
        $this->controller->reRank($targetRank, mockRequest($requestInput));

        //then
        $newItem = Occasion::whereRank(self::last)->first();
        $this->hasSameTitle($item->title, $newItem->title);

        $this->assert_original_and_new_list_within_a_range_is_same(self::first, $targetRank - 1);
        $this->assert_each_item_in_lower_part_is_decremented_by_one($targetRank);
    }


    /** @test */
    function an_item_rank_is_incremented_by_one_when_move_down()
    {
        //given
        $targetRank = random_int(self::first + 1, self::last);
        $targetRankNext = $targetRank + 1;

        //when
        $item = Occasion::whereRank($targetRank)->first();
        $itemNext = Occasion::whereRank($targetRankNext)->first();

        $requestInput = [
            'rankAction' => 'down'
        ];
        $this->controller->reRank($targetRank, mockRequest($requestInput));

        //then  title is swapped
        $newItem = Occasion::whereRank($targetRankNext)->first();
        $this->hasSameTitle($item->title, $newItem->title);

        $newItemNext = Occasion::whereRank($targetRank)->first();
        $this->hasSameTitle($itemNext->title, $newItemNext->title);


        $this->assert_original_and_new_list_within_a_range_is_same(self::first, $targetRank - 1);
        $this->assert_original_and_new_list_within_a_range_is_same($targetRank + 2, self::last);
    }


    /** @test */
    function a_ranker_does_not_accept_wrong_rerank_action()
    {
        //given
        $targetRank = random_int(self::first + 1, self::last);

        //when
        $requestInput = [
            'rankAction' => 'anything'
        ];

        $this->setExpectedException('Exception');

        $this->controller->reRank($targetRank, mockRequest($requestInput));
    }

    /** @test */
    function a_ranker_does_not_accept_too_small_target_rank_number()
    {
        //given
        $targetRank = self::first - 1;

        //when
        $requestInput = [
            'rankAction' => 'up'
        ];

        $this->setExpectedException('Exception');

        $this->controller->reRank($targetRank, mockRequest($requestInput));

        $targetRank = self::first - 10;
        $this->setExpectedException('Exception');

        $this->controller->reRank($targetRank, mockRequest($requestInput));
    }

    /** @test */
    function a_ranker_does_not_accept_too_large_target_rank_number()
    {
        //given
        $requestInput = [
            'rankAction' => 'up'
        ];

        //when
        $targetRank = self::last + 1;

        //expect
        $this->setExpectedException('Exception');

        $this->controller->reRank($targetRank, mockRequest($requestInput));


        $targetRank = self::last + 10;
        $this->setExpectedException('Exception');

        $this->controller->reRank($targetRank, mockRequest($requestInput));
    }


    protected function assert_original_and_new_list_is_same()
    {
        $this->assert_original_and_new_list_within_a_range_is_same(self::first, self::last);
    }


    protected function assert_original_and_new_list_within_a_range_is_same($from, $until)
    {
        $itemNum = $until - $from + 1;

        $list = $this->getNewListWithinARange($from, $until);

        $sliceList = $this->occasions->slice($from - 1, $itemNum);
        $intersectedList = $sliceList->intersect($list);

        $this->assertCount($itemNum,
            $intersectedList,
            "The original and new list ranking from $from to $until should be same.");
    }

    protected function getNewListWithinARange($from, $until)
    {
        return Occasion::whereBetween('rank', [$from, $until])->get();
    }


    protected function assert_each_item_in_upper_part_is_incremented_by_one($targetRank)
    {
        $sliceList = $this->occasions->slice(self::first - 1, $targetRank - 1);

        $upperPart = $this->getNewListWithinARange(self::first + 1, $targetRank);


        $sliceList->each(function ($item, $key) use ($upperPart) {
            $this->assertEquals($item->rank + 1, $upperPart[$key]->rank, 'A correct Rank is expected.');
            $this->assertEquals($item->title, $upperPart[$key]->title, 'A correct Title is expected.');
        });
    }


    protected function assert_each_item_in_lower_part_is_decremented_by_one($targetRank)
    {
        $sliceList = $this->occasions->slice($targetRank, (self::last - $targetRank));
        $lowerPart = $this->getNewListWithinARange($targetRank, self::last - 1);

        $sliceList->each(function ($item, $key) use ($lowerPart, $targetRank) {
            $index = $key - $targetRank;
            $this->assertEquals($item->rank - 1, $lowerPart[$index]->rank, "A correct rank is expected.");
            $this->assertEquals($item->title, $lowerPart[$index]->title, "A correct title is expected.");
        });
    }

    protected function hasSameTitle($titleA, $titleB)
    {
        $this->assertEquals($titleA, $titleB,
            "The old-list-target item and new-list-rank-1 item should have same title.");
    }


}
