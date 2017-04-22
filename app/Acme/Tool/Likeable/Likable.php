<?php


namespace Acme\Tool\Likeable;


/**
 * Interface Likable
 * @package Acme\Tool\Likeable
 */
interface Likable
{
    /**
     *  The model could morphTo likes
     *  return $this->morphMany(Like::class, 'likeable');
     * */
    public function likes();

    /**
     *  The current user could like a model
     * @return mixed
     */
    public function like();

    /**
     *  The current user could unlike a model
     * @return mixed
     */
    public function unlike();


    /**
     *  The model could know if it is liked by the current user
     * @return mixed
     */
    public function isLiked();


    /**
     *  The current user could toggle the like on a model
     * @return mixed
     */
    public function toggleLike();


    /**
     *  The model could know how many  user-likes it has
     * @return mixed
     */
    public function getLikesCountAttribute();

}