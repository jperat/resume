<?php

namespace App\Doctrine\Migrations;

use App\Doctrine\UserPasswordHasherAwareInterface;
use Doctrine\DBAL\Connection;
use Doctrine\Migrations\AbstractMigration;
use Psr\Log\LoggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MigrationFactory implements \Doctrine\Migrations\Version\MigrationFactory
{
    private Connection $connection;
    private LoggerInterface $logger;
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(
        Connection $connection,
        LoggerInterface $logger,
        UserPasswordHasherInterface $userPasswordHasher
    ) {
        $this->connection = $connection;
        $this->logger = $logger;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function createVersion(string $migrationClassName): AbstractMigration
    {
        /** @var  AbstractMigration */
        $migration = new $migrationClassName(
            $this->connection,
            $this->logger
        );

        // or you can ommit this check
        if ($migration instanceof UserPasswordHasherAwareInterface) {
            $migration->setUserPasswordHasher($this->userPasswordHasher);
        }

        return $migration;
    }
}
