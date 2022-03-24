<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class File
{
    private $id;
    private $createdBy;
    private $createdAt;
    private $updatedBy;
    private $updatedAt;
    private $fullPath;
    private $path;
    private $name;
    private $mimeType;
    private $size;
    private $title;
    private $legend;
    private $file;
    private $uploadDir;
    public function __toString(): string
    {
        return $this->title;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }
    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }
    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    public function getFullPath(): ?string
    {
        return $this->fullPath;
    }
    public function setFullPath(string $fullPath): self
    {
        $this->fullPath = $fullPath;
        return $this;
    }
    public function getPath(): ?string
    {
        return $this->path;
    }
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }
    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;
        return $this;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function setSize($size): self
    {
        $this->size = $size;
        return $this;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    public function getLegend(): ?string
    {
        return $this->legend;
    }
    public function setLegend(?string $legend): self
    {
        $this->legend = $legend;
        return $this;
    }
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }
    public function setFile(?UploadedFile $file): void
    {
        $this->file = $file;
    }
    public function getUploadDir(): ?string
    {
        return $this->uploadDir;
    }
    public function setUploadDir(?string $uploadDir): void
    {
        $this->uploadDir = $uploadDir;
    }
}
