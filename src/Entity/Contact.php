<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Contact
 * @package App\Entity
 */
#[ORM\Entity(repositoryClass:ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue(strategy:'AUTO')]
    protected ?int $id;

    #[ORM\Column(name:'name', type:'string', length:255, nullable:false)]
    #[Assert\NotBlank]
    #[Assert\Length(max:255)]
    protected ?string $name;

    #[ORM\Column(name:'phone', type:'string', length:20, nullable:true)]
    #[Assert\Length(max:20)]
    protected ?string $phone;

    #[ORM\Column(name:'email', type:'string', length:255, nullable:false)]
    #[Assert\NotBlank]
    #[Assert\Length(max:255)]
    #[Assert\Email]
    protected ?string $email;

    #[ORM\Column(name:'message', type:'text', length:2048, nullable:false)]
    #[Assert\NotBlank]
    #[Assert\Length(max:2048, min:10)]
    protected ?string $message;

    #[ORM\Column(name:'date', type:'datetime', nullable:false)]
    protected DateTime $date;

    public function __construct()
    {
        $this->date = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }
}
