<?php


namespace Acme\Tool\Ranker;

use Exception;

/**
 *  This is a helper tool to re-rank a model
 *  Only mono-tone model is applied
 * Class Ranker
 * @package App\Models
 */
class Ranker implements RankInterface
{
    protected $rankNow;
    protected $rankLast;
    protected $elements;
    protected $targetElement;


    public function __construct($model, $rankNow)
    {
        $this->rankNow = $rankNow;
        $this->targetElement = $model::whereRank($rankNow)->first();
        $this->elements = $model::oldest('rank')->get();
        $this->rankLast = $this->elements->count();

        $this->guardAgainstWrongTargetRank($rankNow);
    }

    public function handle($rankAction)
    {
        $this->guardAgainWrongRerankAction($rankAction);

        $this->$rankAction();
        $this->targetElement->save();
        return true;
    }


    protected function guardAgainstWrongTargetRank($targetRank)
    {
        if (($targetRank < 1) | ($targetRank > $this->rankLast)) {
            throw new Exception("The rank is out of the legal range.  The rank taken is $targetRank");
        }
    }

    protected function guardAgainWrongRerankAction($rankAction)
    {
        if (!collect(['top', 'up', 'down', 'bottom'])->contains($rankAction)) {
            throw new Exception("Not correct rank change action is provided.  The action taken is $rankAction. ");
        };
    }

    protected function top()
    {
        if ($this->targetElement->rank != 1) {
            for ($position = 0; $position < $this->rankNow - 1; $position++) {
                $this->elements[$position]->rank = ($position + 2);
            }
            $this->targetElement->rank = 1;
            $this->persistUpdatedElements(0, $this->rankNow);
        }
    }

    protected function up()
    {
        if ($this->targetElement->rank != 1) {
            $this->swapRank('up');
            $this->persistUpdatedElements($this->rankNow - 2, 1);
        }
    }

    protected function down()
    {
        if ($this->targetElement->rank != $this->rankLast) {
            $this->swapRank('down');
            $this->persistUpdatedElements($this->rankNow, 1);
        }
    }


    protected function bottom()
    {
        if ($this->targetElement->rank != $this->rankLast) {
            for ($position = $this->rankNow; $position < $this->rankLast; $position++) {
                $this->elements[$position]->rank = $position;
            }
            $this->targetElement->rank = $this->rankLast;
            $this->persistUpdatedElements($this->rankNow, $this->rankLast - $this->rankNow);
        }
    }


    protected function persistUpdatedElements($from = null, $num = null)
    {
        if ($from == null) {
            $this->elements->each(function ($item) {
                $item->save();
            });
        }

        $this->elements->splice($from, $num)->each(
            function ($item) {
                $item->save();
            });
    }

    protected function swapRank($action)
    {
        switch ($action) {
            case 'up':
                $neighbor_position = $this->rankNow - 2;
                $new_rank = $this->rankNow - 1;
                break;
            case 'down':
                $neighbor_position = $this->rankNow;
                $new_rank = $this->rankNow + 1;
                break;
        }

        $this->elements[$neighbor_position]->rank = ($this->rankNow);
        $this->targetElement->rank = ($new_rank);
    }
}