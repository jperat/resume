<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 *
 * @Assert\Expression(
 *     "this.getEnd() == null || this.getStart() < this.getEnd()",
 *     message="The end date must be greater than the start date!"
 * )
 */
class Experience
{

    /**
     *
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string|null
     *
     * @ORM\Column(name="company", type="string", nullable=false)
     */
    private ?string $company;

    /**
     *
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private ?string $title;

    /**
     *
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private ?string $description;

    /**
     *
     * @var DateTime|null
     *
     * @ORM\Column(name="start", type="date", nullable=false)
     */
    private ?DateTime $start;

    /**
     *
     * @var DateTime|null
     *
     * @ORM\Column(name="end", type="date", nullable=true)
     */
    private ?DateTime $end;

    /**
     *
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private bool $active = TRUE;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTime|null
     */
    public function getStart(): ?DateTime
    {
        return $this->start;
    }

    /**
     * @param DateTime|null $start
     */
    public function setStart(?DateTime $start): void
    {
        $this->start = $start;
    }

    /**
     * @return DateTime|null
     */
    public function getEnd(): ?DateTime
    {
        return $this->end;
    }

    /**
     * @param DateTime|null $end
     */
    public function setEnd(?DateTime $end): void
    {
        $this->end = $end;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}

