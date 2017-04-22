<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Area
 * @package Acme\Tool\Addressable\Models
 */
class Area extends Model
{
    protected $table = 'taiwan_area';
    protected $guarded = [];
    public $timestamps = false;
    protected $hidden = ['id','city_id'];
}
