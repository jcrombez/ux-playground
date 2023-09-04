<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tasks')]
    private User $user;

    public function __construct(
        #[ORM\Column(length: 64)]
        private ?string $title = null,

        #[ORM\Column(type: 'integer')]
        #[Gedmo\SortablePosition]
        protected int $position = 0,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function incrementPosition(): self
    {
        $this->position++;

        return $this;
    }

    public function decrementPosition(): self
    {
        $this->position--;

        if ($this->position < 0) {
            $this->position = 0;
        }

        return $this;
    }
}
