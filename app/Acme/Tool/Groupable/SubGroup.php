<?php


namespace Acme\Tool\Groupable;


use Illuminate\Database\Eloquent\Model;

/**
 * Class SubGroup
 * @package Acme\Tool\Groupable
 */
class SubGroup extends Model
{
    protected $table = 'sub_groups';

    public $timestamps = false;

    protected $fillable = ["title", "description"];

    protected $hidden = ['active'];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($subGroup) {
            $subGroup->active = true;
            $subGroup->rank = $subGroup->generateRank($subGroup);
        });
    }


    protected function generateRank(SubGroup $subGroup)
    {
        $group = $subGroup->group()->first();
        return $group->subGroups()->get()->count() + 1;
    }

    /**
     * Get the post that owns the comment.
     */
    public function group()
    {
        return $this->belongsTo(Groupable::class, 'group_id');
    }
}