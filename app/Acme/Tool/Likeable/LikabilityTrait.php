<?php namespace Acme\Tool\Likeable;

use Auth;

/**
 * Class LikabilityTrait
 * @package Acme\Tool\Likeable
 */
trait LikabilityTrait
{
    /**
     *  The device could morphTo likes
     * */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * @return $this
     */
    public function like()
    {
        $like = new Like(['user_id' => Auth::id()]);

        $this->likes()->save($like);

        return $this;
    }


    public function unlike()
    {
        $this->likes()
            ->where('user_id', Auth::id())
            ->delete();

        return $this;
    }


    public function isLiked()
    {
        return !!$this->likes()
            ->where('user_id', Auth::id())
            ->count();
    }

    public function toggleLike()
    {
        if ($this->isLiked()) {
            return $this->unlike();
        }

        return $this->like();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}