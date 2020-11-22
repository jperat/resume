<?php


namespace App\Repository;


use App\Entity\Config;
use App\Model\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ConfigRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Config::class);
    }

    public function getUser(): User
    {
        $configs = $this->createQueryBuilder('c')
            ->where("c.key IN ('login_email', 'login_password')")
            ->getQuery()
            ->execute();
        $user = new User();
        /** @var Config $config */
        foreach ($configs as $config) {
            if ($config->getKey() == 'login_email') {
                $user->setEmail($config->getValue());
            } else {
                $user->setPassword($config->getValue());
            }
        }
        return $user;
    }

    public function getIndexConfig(): array
    {
        $configs = $this->getIndexFormConfig();
        $datas = [];
        /** @var Config $config */
        foreach ($configs as $config) {
            $datas[$config->getKey()] = $config->getValue();
        }
        return $datas;
    }

    public function getIndexFormConfig(): array
    {
        return $this->createQueryBuilder('c')
            ->where("c.key NOT IN ('login_email', 'login_password')")
            ->getQuery()
            ->execute();
    }

    public function getLoginFormConfig(): array
    {
        return $this->createQueryBuilder('c')
            ->where("c.key IN ('login_email', 'login_password')")
            ->getQuery()
            ->execute();
    }

}