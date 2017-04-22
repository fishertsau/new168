<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleUser
 * @package App\Models\Authorization
 */
class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        //�򥻸��
        'role_id',
        'user_id',
    ];
}
