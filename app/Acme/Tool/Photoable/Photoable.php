<?php


namespace Acme\Tool\Photoable;


/**
 * Interface Photoable
 * @package Acme\Tool\Photoable
 */
interface Photoable
{
    public function photos();

    /**
     * @param $field
     * @return mixed
     */
    public function getFieldPhoto($field);

    public function getPhotoDir();
}