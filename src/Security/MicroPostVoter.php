<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 11/25/18
 * Time: 2:40 PM
 */

namespace App\Security;


use App\Entity\MicroPost;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MicroPostVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        if(!$subject instanceof MicroPost) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $authenticateUser = $token->getUser();

        if(!$authenticateUser instanceof User) {
            return false;
        }

        /** @var MicroPost $microPost */
        $microPost = $subject;

        return $microPost->getUser()->getId() === $authenticateUser->getId();

    }
}