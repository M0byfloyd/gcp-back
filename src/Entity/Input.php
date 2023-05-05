<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InputRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InputRepository::class)]
#[ApiResource]
class Input
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'inputs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Form $form = null;

    #[ORM\Column]
    private ?bool $value = null;

    #[ORM\Column]
    private ?bool $userValue = null;

    #[ORM\ManyToOne(inversedBy: 'inputs')]
    private ?Question $question = null;

    #[ORM\ManyToOne(inversedBy: 'inputs')]
    private ?Response $response = null;

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

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(?Response $response): self
    {
        $this->response = $response;

        return $this;
    }
}
