<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

#[ORM\Entity(repositoryClass:EducationRepository::class)]
#[Assert\Expression(
    'this.getEnd() == null || this.getStart() < this.getEnd()',
    message:'The end date must be greater than the start date!'
)]
class Education
{
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    private ?int $id;

    #[ORM\Column(name:'school', type:'string', length:255, nullable:false)]
    private ?string $school;

    #[ORM\Column(name:'title', type:'string', length:255, nullable:false)]
    private ?string $title;

    #[ORM\Column(name:'description', type:'text', nullable:true)]
    private ?string $description;

    #[ORM\Column(name:'start', type:'date', nullable:false)]
    private ?DateTime $start;

    #[ORM\Column(name:'end', type:'date', nullable:true)]
    private ?DateTime $end;

    #[ORM\Column(name:'active', type:'boolean', nullable:false)]
    private bool $active = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(?string $school): void
    {
        $this->school = $school;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getStart(): ?DateTime
    {
        return $this->start;
    }

    public function setStart(?DateTime $start): void
    {
        $this->start = $start;
    }

    public function getEnd(): ?DateTime
    {
        return $this->end;
    }

    public function setEnd(?DateTime $end): void
    {
        $this->end = $end;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
