<?php

namespace Acme\Tool\Likeable;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 * @package Acme\Tool\Likeable
 */
class Like extends Model
{
    protected $fillable = ['user_id'];

    /**
     * Get all of the owning commentable models.
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
