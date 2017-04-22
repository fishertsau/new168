<?php


namespace Acme\Tool\Discussionable;


/**
 * Interface Discussionable
 * @package Acme\Tool\Discussionable
 */
interface Discussionable
{
    /**
     *  The model could morphTo discussions
     * */
    public function discussions();

//    /**
//     *  The current user could raise a discussion regarding the model
//     * @param null $content
//     * @return mixed
//     */
//    public function raiseDiscussion($content = null);
//
//    /**
//     *  The current user could cease or leave a discussion regarding the model
//     * @param Discussion $discussion
//     * @return mixed
//     */
//    public function ceaseDiscussion(Discussion $discussion);
//
//    /**
//     *  The associated model could know how many discussions are raised about it
//     * @return mixed
//     */
//    public function getDiscussionsCountAttribute();
}