<?php

namespace App\Entity;

use DateTime;
use App\Entity\SubjectProject;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SubjectRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ApiResource(
 *      collectionOperations={"get","post"},
 *      itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "add_project": {
 *              "method": "PUT",
 *              "path": "/subjects/{id}/projects/{projectId}",
 *              "controller": SubjectAddProject::class
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 */
class Subject
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="SubjectProject")
     * @ORM\JoinTable(
     *      name="subject_projects",
     *      joinColumns={@ORM\JoinColumn(name="subject_id", referencedColumnName="id")},
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="project_id", referencedColumnName="id",onDelete="CASCADE")
     *      }
     * )
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        if(!$this->createdAt) {
            $this->createdAt = new DateTime();
        }
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(SubjectProject $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
        }

        return $this;
    }

    public function removeProject(SubjectProject $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeSubject($this);
        }

        return $this;
    }
}
