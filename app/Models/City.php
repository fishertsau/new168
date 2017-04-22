<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package Acme\Tool\Addressable\Models
 */
class City extends Model
{
    protected $guarded = [];
    protected $table = 'taiwan_city';
    public $timestamps = false;
    protected $hidden = ['district'];
}
