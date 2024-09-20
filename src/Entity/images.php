<?php
#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
 
    #[ORM\Column(length: 255)]
    private ?string $url = null;
 
    #[ORM\Column(length: 255)]
    private ?string $altText = null;
}