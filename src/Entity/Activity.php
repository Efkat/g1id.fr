<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
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
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="activities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\OneToMany(targetEntity=ActivityChapter::class, mappedBy="Activity")
     */
    private $activityChapters;

    /**
     * @ORM\Column (type="string", length=255)
     *
     * @Gedmo\Slug(fields={"Title"})
     */
    private $slug;



    public function __construct()
    {
        $this->activityChapters = new ArrayCollection();
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
     * @return Collection|ActivityChapter[]
     */
    public function getActivityChapters(): Collection
    {
        return $this->activityChapters;
    }

    public function addActivityChapter(ActivityChapter $activityChapter): self
    {
        if (!$this->activityChapters->contains($activityChapter)) {
            $this->activityChapters[] = $activityChapter;
            $activityChapter->setActivity($this);
        }

        return $this;
    }

    public function removeActivityChapter(ActivityChapter $activityChapter): self
    {
        if ($this->activityChapters->removeElement($activityChapter)) {
            // set the owning side to null (unless already changed)
            if ($activityChapter->getActivity() === $this) {
                $activityChapter->setActivity(null);
            }
        }

        return $this;
    }

    public function __toString() : String
    {
        return $this->getTitle();
    }
}
