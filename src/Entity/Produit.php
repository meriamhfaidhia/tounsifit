<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Allergie", mappedBy="produit")
     */
    private $allergie = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="LikeDislike", mappedBy="produit")
     */
    private $likeDislike = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Panier", inversedBy="idProduit")
     * @ORM\JoinTable(name="produit_panier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ID_Produit", referencedColumnName="id_produit")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_Panier", referencedColumnName="id_panier")
     *   }
     * )
     */
    private $idPanier = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->allergie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likeDislike = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPanier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

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

    /**
     * @return Collection<int, Allergie>
     */
    public function getAllergie(): Collection
    {
        return $this->allergie;
    }

    public function addAllergie(Allergie $allergie): static
    {
        if (!$this->allergie->contains($allergie)) {
            $this->allergie->add($allergie);
            $allergie->addProduit($this);
        }

        return $this;
    }

    public function removeAllergie(Allergie $allergie): static
    {
        if ($this->allergie->removeElement($allergie)) {
            $allergie->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, LikeDislike>
     */
    public function getLikeDislike(): Collection
    {
        return $this->likeDislike;
    }

    public function addLikeDislike(LikeDislike $likeDislike): static
    {
        if (!$this->likeDislike->contains($likeDislike)) {
            $this->likeDislike->add($likeDislike);
            $likeDislike->addProduit($this);
        }

        return $this;
    }

    public function removeLikeDislike(LikeDislike $likeDislike): static
    {
        if ($this->likeDislike->removeElement($likeDislike)) {
            $likeDislike->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getIdPanier(): Collection
    {
        return $this->idPanier;
    }

    public function addIdPanier(Panier $idPanier): static
    {
        if (!$this->idPanier->contains($idPanier)) {
            $this->idPanier->add($idPanier);
        }

        return $this;
    }

    public function removeIdPanier(Panier $idPanier): static
    {
        $this->idPanier->removeElement($idPanier);

        return $this;
    }

}
