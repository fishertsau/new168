<?php


namespace App\Service;


use App\Repository\UserRepository;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    protected $userRepository;

    /**
     * UserService constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return null
     */
    public function getUserForPublicUse()
    {
        return auth()->check() ? auth()->user()->setVisible(['name', 'email', 'avatar']) : null;
    }
}