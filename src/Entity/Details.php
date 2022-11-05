<?php

namespace App\Entity;

use App\Repository\DetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsRepository::class)]
class Details
{

    #[ORM\Column(type: 'integer')]
    private $prixUnit;

    #[ORM\Column(type: 'integer')]
    private $quantite;


    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Commandes::class, inversedBy: 'details')]
    #[ORM\JoinColumn(nullable: false)]
    private $IdCommandes;
    
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produits::class, inversedBy: 'details')]
    #[ORM\JoinColumn(nullable: false)]
    private $IdProduits;


    public function getPrixUnit(): ?int
    {
        return $this->prixUnit;
    }

    public function setPrixUnit(int $prixUnit): self
    {
        $this->prixUnit = $prixUnit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

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

    public function getIdProduits(): ?Produits
    {
        return $this->IdProduits;
    }

    public function setIdProduits(?Produits $IdProduits): self
    {
        $this->IdProduits = $IdProduits;

        return $this;
    }
}
