<?php
namespace Acme\Tool\Ownable;

use App\User;


/**
 * Interface Ownable
 */
interface Ownable
{
    public function ownedBy(User $user);
}