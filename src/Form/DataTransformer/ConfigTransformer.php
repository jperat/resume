<?php

namespace App\Form\DataTransformer;

use App\Entity\Config;
use App\Model\User;
use App\Repository\ConfigRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ConfigTransformer implements DataTransformerInterface
{
    private ConfigRepository $configRepository;
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(ConfigRepository $configRepository, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->configRepository = $configRepository;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function transform(mixed $value): mixed
    {
        return $value;
    }

    /**
     * @param mixed $values
     * @return array
     */
    public function reverseTransform(mixed $values): mixed
    {
        $configs = [];
        foreach ($values as $key => $value) {
            /** @var Config $config */
            $config = $this->configRepository->find($key);
            if ($config->getType() == 'password') {
                $config->setValue($this->getPassword($value));
            } else {
                $config->setValue($value);
            }
            $configs[] = $config;
        }
        return $configs;
    }

    private function getPassword(string $password): string
    {
        return $this->userPasswordHasher->hashPassword(new User(), $password);
    }
}
