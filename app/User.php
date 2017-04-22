<?php

namespace App;

use Acme\Tool\Ownable\Ownable;
use App\Events\User\UserEmailChanged;
use App\Models\Vendor;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User
 * @property bool verified
 * @property string verified_token
 * @package App
 */
class User extends Authenticatable implements Ownable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden =
        ['id', 'password', 'verified_token', 'remember_token', 'created_at', 'updated_at'];

    protected $casts = [
        'verified' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->generateVerifiedToken();
        });

        static::updating(function ($user) {
            $user->unVerifyIfEmailChanged();
        });
    }


    public function unVerifyIfEmailChanged()
    {
        if (collect($this->getDirty())->has('email')) {
            $this->verified = false;
            $this->verified_token = str_random(30);
            event(new UserEmailChanged($this));
        }
    }


    public function generateVerifiedToken()
    {
        $this->verified_token = str_random(30);
        return $this;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasMany('App\Models\Device\Device');
    }

    public function ownedBy(User $user)
    {
        return $this->id === $user->id;
    }


    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

//    /**
//     * @param $relatedEntry
//     * @return bool
//     */
//    public
//    function owns($relatedEntry)
//    {
//        return $this->id == $relatedEntry->user_id;
//    }


    public function getVerifiedAttribute($value)
    {
        return !!$value;
    }

    public function getVerifiedTokenAttribute($value)
    {
        return $value;
    }

    public function verified()
    {
        return $this->verified;
    }

    public function getSignInCountAttribute($value)
    {
        return ($value === null) ? 0 : $value;
    }

//    public function getSignInAtAttribute($value)
//    {
//        return $value;
//    }
//
//    public function getSignInIpAttribute($value)
//    {
//        return $value;
//    }
}
