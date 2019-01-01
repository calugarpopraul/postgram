<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 12/31/18
 * Time: 10:57 PM
 */

namespace App\Event;


use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserRegisterEvent extends Event
{
    const NAME = 'user.register';

    /**
     * @var User
     */
    private $registeredUser;

    public function __construct(User $registeredUser)
    {
        $this->registeredUser = $registeredUser;
    }

    public function getRegisteredUser(): User
    {
        return $this->registeredUser;
    }

}