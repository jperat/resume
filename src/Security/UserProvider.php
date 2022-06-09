<?php

namespace App\Security;

use App\Model\User;
use App\Repository\ConfigRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private ConfigRepository $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function loadUserByIdentifier(string $username): UserInterface
    {
        $user = $this->configRepository->getUser();
        if ($user->getUserIdentifier() === $username) {
            return $user;
        }
        throw new UserNotFoundException();
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException();
        }
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class)
    {
        return User::class === $class;
    }
}
