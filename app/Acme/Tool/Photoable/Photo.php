<?php

namespace Acme\Tool\Photoable;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 * @package Acme\Tool\Photoable
 */
class Photo extends Model
{
    protected $fillable = [
        'dir',
        'field',
        'filepath'
    ];

    protected $hidden = ['id', 'photoable_id', 'photoable_type', 'dir'];

    public $timestamps = false;

    const dirDefault = 'photos';

    const baseDirectory = '/images/';

    public static function boot()
    {
        parent::boot();

        static::updated(function ($photo) {
            $photo->checkPhotoFileChanged();
        });

        static::deleting(function ($photo) {
            $photo->deletePhotoFile($photo->filepath);
        });
    }


    public function photoable()
    {
        return $this->morphTo();
    }


    private function checkPhotoFileChanged()
    {
        if (collect($this->getDirty())->has('filepath')) {
            $this->deletePhotoFile($this->getOriginal('filepath'));
        }
    }


    private function deletePhotoFile($filepath)
    {
        \File::delete(public_path() . $filepath);
    }
}
