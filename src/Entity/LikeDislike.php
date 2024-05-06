<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LikeDislike
 *
 * @ORM\Table(name="like_dislike")
 * @ORM\Entity
 */
class LikeDislike
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="produit_id", type="integer", nullable=true)
     */
    private $produitId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="likes", type="integer", nullable=true)
     */
    private $likes = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="dislikes", type="integer", nullable=true)
     */
    private $dislikes = '0';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="likeDislike")
     * @ORM\JoinTable(name="likedislike_produit",
     *   joinColumns={
     *     @ORM\JoinColumn(name="like_dislike_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="produit_id", referencedColumnName="id_produit")
     *   }
     * )
     */
    private $produit = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduitId(): ?int
    {
        return $this->produitId;
    }

    public function setProduitId(?int $produitId): static
    {
        $this->produitId = $produitId;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    public function setDislikes(?int $dislikes): static
    {
        $this->dislikes = $dislikes;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->produit->removeElement($produit);

        return $this;
    }

}
