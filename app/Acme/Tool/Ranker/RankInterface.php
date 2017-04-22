<?php


namespace Acme\Tool\Ranker;


/**
 * Interface RankInterface
 * @package Acme\Tool\Ranker
 */
interface RankInterface
{
    /**
     * @param $rankAction: 'top', 'up','down','bottom'
     *
     * @return mixed
     */
    public function handle($rankAction);
}