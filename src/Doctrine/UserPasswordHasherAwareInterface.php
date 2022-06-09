<?php

namespace App\Doctrine;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

interface UserPasswordHasherAwareInterface
{
    public function setUserPasswordHasher(UserPasswordHasherInterface $userPasswordHasher): void;
}
