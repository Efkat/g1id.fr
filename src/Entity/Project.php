<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @ORM\Column (type="string", length=255)
     *
     * @Gedmo\Slug(fields={"Title"})
     */
    private $slug;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\Range(
     *     min=1,
     *     max=5,
     *     notInRangeMessage="La note de difficulté doit être comprise dans [1;5]"
     * )
     */
    private $Difficulty;

    public function __construct()
    {
        $this->projectChapters = new ArrayCollection();
        $this->CreatedAt = new \DateTime();
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

    public function setSlug(string $slug) : self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug() : ?string
    {
        return $this->slug;
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

    public function __toString() : String
    {
        return $this->getTitle();
    }

    public function getDifficulty(): ?int
    {
        return $this->Difficulty;
    }

    public function setDifficulty(int $Difficulty): self
    {
        $this->Difficulty = $Difficulty;

        return $this;
    }
}
