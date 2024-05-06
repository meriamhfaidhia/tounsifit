<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_panier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPanier;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=255, nullable=false)
     */
    private $nomProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_produit", type="integer", nullable=false)
     */
    private $prixProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

   /**
 * @var int
 *
 * @ORM\Column(name="quantity", type="integer", options={"default": 1})
 */
private $quantity = 1;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="idPanier")
     */
    private $idUser = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="idPanier")
     */
    private $idProduit = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUser = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdPanier(): ?int
    {
        return $this->idPanier;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(User $idUser): static
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser->add($idUser);
            $idUser->addIdPanier($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): static
    {
        if ($this->idUser->removeElement($idUser)) {
            $idUser->removeIdPanier($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getIdProduit(): Collection
    {
        return $this->idProduit;
    }

    public function addIdProduit(Produit $idProduit): static
    {
        if (!$this->idProduit->contains($idProduit)) {
            $this->idProduit->add($idProduit);
            $idProduit->addIdPanier($this);
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): static
    {
        if ($this->idProduit->removeElement($idProduit)) {
            $idProduit->removeIdPanier($this);
        }

        return $this;
    }

}
