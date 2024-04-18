<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\PanierRepository;

#[ORM\Entity(repositoryClass: PanierRepository::class)]

class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idPanier;

    #[ORM\IdProduit]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idproduit=null;

    #[ORM\Column(length: 255)]
    private ?string $nomproduit= null;

    #[ORM\PrixProduit]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $prixproduit=null;

    #[ORM\IdUser]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $iduser=null;

    public function getIdPanier(): ?int
    {
        return $this->idPanier;
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function setIdProduit(int $idProduit): static
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): static
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getPrixProduit(): ?int
    {
        return $this->prixProduit;
    }

    public function setPrixProduit(int $prixProduit): static
    {
        $this->prixProduit = $prixProduit;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }


}
