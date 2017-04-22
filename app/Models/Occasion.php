<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Occasion
 * @package App\Models
 */
class Occasion extends Model
{
    protected $fillable = ['title', 'active'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($occasion) {

            if (self::hasTitle($occasion)) {
                return false;
            }

            $occasion->rank = count(Occasion::all()) + 1;
        });

        static::deleting(function ($occasion) {
            return false;
        });
    }

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $hidden = ['rank', 'active', 'pivot'];

    /**
     * The users that belong to the role.
     */
    public function devices()
    {
        return $this->belongsToMany('App\Models\Device\Device');
    }


    protected static function hasTitle($occasion)
    {
        return Occasion::whereTitle($occasion->title)->exists();
    }


    public function scopeKeywordBy($query, $keyword_by, $keyword)
    {
        if (!empty($keyword_by)) {
            //add wildcard before and after keyword
            $keyword = '%' . $keyword . '%';

            if ($keyword_by == 'title') {
                return $query->where('title', 'like', $keyword);
            }
        }

    }


    public function scopeActive($query, $active)
    {
        if ($active == '') {
            return;
        }
        return $query->whereActive($active);
    }


    public function getActiveAttribute($active)
    {
        return $active ? '正常' : '停用';
    }

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = ($value == true);
    }
}
