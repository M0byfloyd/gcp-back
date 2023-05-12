<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InputRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: InputRepository::class)]
#[ApiResource]
class Input
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Ignore]
    #[ORM\ManyToOne(inversedBy: 'inputs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Form $form = null;

    #[Ignore]
    #[ORM\Column]
    private ?bool $value = null;
    #[Groups(['formDetail'])]
    #[ORM\Column(nullable: true)]
    private ?bool $userValue = null;

    #[ORM\ManyToOne(inversedBy: 'inputs')]
    private ?Question $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getForm(): ?Form
    {
        return $this->form;
    }

    public function setForm(?Form $form): self
    {
        $this->form = $form;

        return $this;
    }

    public function isValue(): ?bool
    {
        return $this->value;
    }

    public function setValue(bool $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function isValueUser(): ?bool
    {
        return $this->userValue;
    }

    public function setUserValue(bool $userValue): self
    {
        $this->userValue = $userValue;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
