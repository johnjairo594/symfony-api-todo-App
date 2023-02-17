<?php

namespace src\Domain\User\Model;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use LogicException;
use src\Domain\ToDo\Model\ToDo;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private string $id;
    private string $name;
    private string $email;
    private ?string $password;
    private ?string $token;
    private bool $active;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private Collection $toDos;


    public function __construct(string $name, string $email)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->setEmail($email);
        $this->password = null;
        $this->token = sha1(uniqid());
        $this->active = true;
        $this->createdAt = new DateTime();
        $this->markAsUpdated();
        $this->toDos = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new LogicException('Invalid email');
        }
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getSalt(): void
    {
    }

    public function eraseCredentials(): void
    {
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function __call($name, $arguments):void
    {
    }

    public function getToDos(): Collection
    {
        return $this->toDos;
    }

    public function addToDoToCollection(ToDo $toDo): void
    {
        if ($this->toDos->contains($toDo)) {
            return;
        }

        $this->toDos->add($toDo);
    }

    public function removeToDoFromCollection(ToDo $toDo): void
    {
        if ($this->toDos->contains($toDo)) {
            $this->toDos->removeElement($toDo);
        }
    }

    public function containsToDoInCollection(ToDo $toDo): bool
    {
        return $this->toDos->contains($toDo);
    }

}