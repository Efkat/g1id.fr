<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
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
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="courses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\OneToMany(targetEntity=CourseChapter::class, mappedBy="Course")
     */
    private $courseChapters;

    public function __construct()
    {
        $this->courseChapters = new ArrayCollection();
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
     * @return Collection|CourseChapter[]
     */
    public function getCourseChapters(): Collection
    {
        return $this->courseChapters;
    }

    public function addCourseChapter(CourseChapter $courseChapter): self
    {
        if (!$this->courseChapters->contains($courseChapter)) {
            $this->courseChapters[] = $courseChapter;
            $courseChapter->setCourse($this);
        }

        return $this;
    }

    public function removeCourseChapter(CourseChapter $courseChapter): self
    {
        if ($this->courseChapters->removeElement($courseChapter)) {
            // set the owning side to null (unless already changed)
            if ($courseChapter->getCourse() === $this) {
                $courseChapter->setCourse(null);
            }
        }

        return $this;
    }
}
