<?php

namespace App\Entity;

use App\Repository\LivraisonsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonsRepository::class)]
class Livraisons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $dateprevu;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $dateliv;

    #[ORM\OneToOne(targetEntity: Commandes::class, cascade: ['persist', 'remove'])]
    private $IdCommandes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateprevu(): ?\DateTimeInterface
    {
        return $this->dateprevu;
    }

    public function setDateprevu(?\DateTimeInterface $dateprevu): self
    {
        $this->dateprevu = $dateprevu;

        return $this;
    }

    public function getDateliv(): ?\DateTimeInterface
    {
        return $this->dateliv;
    }

    public function setDateliv(\DateTimeInterface $dateliv): self
    {
        $this->dateliv = $dateliv;

        return $this;
    }

    public function getIdCommandes(): ?Commandes
    {
        return $this->IdCommandes;
    }

    public function setIdCommandes(?Commandes $IdCommandes): self
    {
        $this->IdCommandes = $IdCommandes;

        return $this;
    }
}
