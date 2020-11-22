<?php


namespace App\Form\DataTransformer;


use App\Model\User;
use App\Repository\ConfigRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ConfigTransformer implements DataTransformerInterface
{

    private ConfigRepository $configRepository;
    private UserPasswordEncoderInterface  $passwordEncoder;

    public function __construct(ConfigRepository $configRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->configRepository = $configRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function transform($value)
    {
    }

    public function reverseTransform($values)
    {
        $configs = [];
        foreach ($values as $key => $value) {
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
        return $this->passwordEncoder->encodePassword(new User(), $password);
    }

}