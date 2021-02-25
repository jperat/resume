<?php


namespace App\Tests\unit\Security;


use App\Entity\Config;
use App\Model\User;
use App\Repository\ConfigRepository;
use App\Security\UserProvider;
use PHPUnit\Framework\TestCase;

class UserProviderTest extends TestCase
{

    private UserProvider $userProvider;


    public function setUp(): void
    {
        parent::setUp();
        $configRepository = $this->createMock(ConfigRepository::class);
        $this->userProvider = new UserProvider($configRepository);
    }

    public function testSupportsClass(): void
    {
        $this->assertTrue($this->userProvider->supportsClass(User::class));
        $this->assertFalse($this->userProvider->supportsClass(Config::class));
    }
}