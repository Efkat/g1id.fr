<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ModifiedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Content;

    /**
     * @ORM\Column(type="text")
     */
    private $Help;

    /**
     * @ORM\Column(type="text")
     */
    private $Correction;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->ModifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $ModifiedAt): self
    {
        $this->ModifiedAt = $ModifiedAt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getHelp(): ?string
    {
        return $this->Help;
    }

    public function setHelp(string $Help): self
    {
        $this->Help = $Help;

        return $this;
    }

    public function getCorrection(): ?string
    {
        return $this->Correction;
    }

    public function setCorrection(string $Correction): self
    {
        $this->Correction = $Correction;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
}
