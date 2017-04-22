<?php


namespace Acme\Tool\Photoable;


/**
 * Class PhotoabilityTrait
 * @package Acme\Tool\Photoable
 */
trait PhotoabilityTrait
{
    /**
     * Get all of the video's comments.
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }


    /**
     * @param $field
     * @return mixed
     */
    public function getFieldPhoto($field)
    {
        return $this->photos()->whereField($field)->first();
    }



    /** get the directory where photos for this model should be stored
     *  the property $photoDir should be defined
     * @return mixed
     */
    public function getPhotoDir()
    {
        return property_exists($this, 'photoDir') ?
            $this->photoDir : null;
    }
}