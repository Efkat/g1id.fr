<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=450)
     */
    private $Summary;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\OneToMany(targetEntity=ProjectChapter::class, mappedBy="Project")
     */
    private $projectChapters;

    public function __construct()
    {
        $this->projectChapters = new ArrayCollection();
    }

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

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->Summary;
    }

    public function setSummary(string $Summary): self
    {
        $this->Summary = $Summary;

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

    /**
     * @return Collection|ProjectChapter[]
     */
    public function getProjectChapters(): Collection
    {
        return $this->projectChapters;
    }

    public function addProjectChapter(ProjectChapter $projectChapter): self
    {
        if (!$this->projectChapters->contains($projectChapter)) {
            $this->projectChapters[] = $projectChapter;
            $projectChapter->setProject($this);
        }

        return $this;
    }

    public function removeProjectChapter(ProjectChapter $projectChapter): self
    {
        if ($this->projectChapters->removeElement($projectChapter)) {
            // set the owning side to null (unless already changed)
            if ($projectChapter->getProject() === $this) {
                $projectChapter->setProject(null);
            }
        }

        return $this;
    }
}
