<?php namespace Acme\Tool\Discussionable\Models;

use Acme\Tool\Ownable\Ownable;
use App\User;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Discussion
 * @package Acme\Tool\Discussionable\Models
 */
class Discussion extends Model implements Ownable
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

//        static::created(function ($discussion) {
//            event(new DiscussionRaised($discussion));
//        });
    }

//    /**
//     * Get all of the owning discussionable models.
//     */
//    public function discussionable()
//    {
//        return $this->morphTo();
//    }


    public function dialogues()
    {
        return $this->hasMany(Dialogue::class);
    }
    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }
}