<?php


namespace App\Repository;

use App\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserRepository
 * @package Acme\User
 */
class UserRepository
{
    /**
     * @param null $attribute
     * @param $value
     * @return \Exception|ModelNotFoundException
     */
    public static function findUserByAttribute($attribute = null, $value)
    {
        try {
            $user = User::where($attribute, $value)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw $e;
        }

        return $user;
    }


    /**
     * @param $data
     * @return static
     */
    public function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    /**
     * @param $verified_token
     * @return User
     */
    public static function confirmEmail($verified_token)
    {
        try {
            $user = self::findUserByAttribute('verified_token', $verified_token);
        } catch (ModelNotFoundException $e) {
            throw $e;
        }


        self::verify($user);

        return $user;
    }

    public static function unverify(User $user)
    {
        $user->update([
            'verified' => false,
            'verified_token' => str_random(30),
        ]);
    }

    public static function verify(User $user)
    {
        $user->update([
            'verified' => true,
            'verified_token' => null,
        ]);
    }


    public function stampSignIn($user, $time, $ip)
    {
        $user->increment('signIn_count');

        $user->last_signIn_at = $user->signIn_at;
        $user->signIn_at = $time;

        $user->last_signIn_ip = $user->signIn_ip;
        $user->signIn_ip = $ip;

        $user->save();
    }


    public static function findByEmail($email)
    {
        return User::whereEmail($email)->first();
    }


    /**
     * @param User $user
     * @param $param
     * @return Vendor
     */
    private function createVendor(User $user, $param)
    {
        $vendor = $user->vendor()->create($param);

        return $vendor;
    }

    public function createOrUpdateVendor(User $user, $param)
    {
        if (!(($vendor = $user->fresh()->vendor) === null)) {
            $vendor->update($param);
            return $vendor;
        }

        return $this->createVendor($user, $param);
    }
}