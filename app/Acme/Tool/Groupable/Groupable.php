<?php

namespace Acme\Tool\Groupable;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Groupable
 * @package Acme\Tool\Groupable
 */
class Groupable extends Model
{
    protected $table = 'groups';

    public $timestamps = false;

    public $type;

    protected $fillable = ["title", "description"];

    protected $hidden = ['active', 'groupable_type'];

    /**
     * Groupable constructor.
     * @param array $attributes
     * @internal param $type
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->type = $this->getGroupName();
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function ($group) {
            $group->active = true;
            $group->groupable_type = $group->getGroupName();
            $group->rank = $group->memberCount() + 1;
        });
    }

    public function subGroups()
    {
        return $this->hasMany(SubGroup::class, 'group_id');
    }

    protected function getGroupName()
    {
        return get_class($this);
    }

    public static function memberCount()
    {
        return self::members()->count();
    }

    public static function members()
    {
        return self::where('groupable_type', get_class(new static))->get();
    }

    public function addSubMember(array $info = [])
    {
        return $this->subGroups()->create($info);
    }
}