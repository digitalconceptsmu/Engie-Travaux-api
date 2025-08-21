<?php

namespace App\Entity\Lead;

use App\ApiPlatform\State\Processor\Lead\LeadRegistrationProcessor;
use App\Repository\Lead\LeadRepository;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Shared\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LeadRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['timestampable:read', 'lead:read']
    ],
    denormalizationContext: [
        'groups' => ['lead:write']
    ],
    operations:[
        new Post (processor: LeadRegistrationProcessor::class)
    ],
    extraProperties: [
        'standard_put' => false,
    ]
)]
#[ORM\Table(name: '`lead`')]
#[ORM\HasLifecycleCallbacks]
class Lead
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['lead:write'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['lead:write'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['lead:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['lead:write'])]
    private ?string $phone = null;

    #[ORM\Column]
    #[Groups(['lead:write'])]
    private ?bool $consent = null;

    public function __construct()
    {
       $this->consent = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function isConsent(): ?bool
    {
        return $this->consent;
    }

    public function setConsent(bool $consent): static
    {
        $this->consent = $consent;

        return $this;
    }
}
