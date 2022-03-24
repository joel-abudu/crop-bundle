<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
class User implements UserInterface
{
    private $id;
    private $email;
    private $roles = [];
    private $password;
    private $avatar;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    public function getPassword(): string
    {
        return (string) $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getSalt(): void
    {
    }
    public function eraseCredentials(): void
    {
    }
    public function getAvatar(): ?File
    {
        return $this->avatar;
    }
    public function setAvatar(?File $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }
}
