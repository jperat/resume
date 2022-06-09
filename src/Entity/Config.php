<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ConfigRepository;

/**
 * Class Config
 * @package App\Entity
 */
#[ORM\Entity(repositoryClass:ConfigRepository::class)]
class Config
{
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    protected ?int $id;

    #[ORM\Column(type:'string')]
    protected string $key;

    #[ORM\Column(type:'text')]
    protected string $value;

    #[ORM\Column(type:'string')]
    protected string $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
