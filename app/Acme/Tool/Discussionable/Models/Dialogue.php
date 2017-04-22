<?php

namespace Acme\Tool\Discussionable\Models;


use Acme\Tool\Discussionable\Events\DialogueJoined;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dialogue
 * @package Acme\Tool\Discussionable\Models
 */
class Dialogue extends Model
{
    protected $fillable = ['user_id', 'content'];


    public static function boot()
    {
        parent::boot();

        static::created(function ($dialogue) {
            event(new DialogueJoined($dialogue));
        });
    }


    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
}
