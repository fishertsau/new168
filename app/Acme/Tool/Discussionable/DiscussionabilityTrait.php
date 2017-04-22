<?php


namespace Acme\Tool\Discussionable;

use Acme\Tool\Discussionable\Models\Discussion;
use Auth;
use Exception;

/**
 * Class DiscussionabilityTrait
 * @package Acme\Tool\Discussionable
 */
trait DiscussionabilityTrait
{
    /**
     *  The device could morphTo likes
     * */
    public function discussions()
    {
        return $this->morphMany(Discussion::class, 'discussionable');
    }
}