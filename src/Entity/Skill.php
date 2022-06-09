<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    private ?int $id;

    #[ORM\Column(name:'title', type:'string', length:255, nullable:false)]
    private ?string $title;

    #[ORM\Column(name:'rate', type:'smallint', nullable:false)]
    private int $rate = 0;


    #[ORM\Column(name:'position', type:'smallint', nullable:false)]
    private int $position = 0;

    #[ORM\Column(name:'active', type:'boolean', nullable:false)]
    private bool $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
