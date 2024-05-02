<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * InformationEducatif
 *
 * @ORM\Table(name="information_educatif", indexes={@ORM\Index(name="id_allergie", columns={"id_allergie"})})
 * @ORM\Entity
 */
class InformationEducatif
{
    /**
     * @var int
     *
     * @ORM\Column(name="idInformation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idinformation;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="symptome", type="string", length=255, nullable=true)
     */
    private $symptome;

    /**
     * @var string|null
     *
     * @ORM\Column(name="causes", type="text", length=65535, nullable=true)
     */
    private $causes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="traitement", type="text", length=65535, nullable=true)
     */
    private $traitement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_allergie", type="integer", nullable=true)
     */
    private $idAllergie;

    public function getIdinformation(): ?int
    {
        return $this->idinformation;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSymptome(): ?string
    {
        return $this->symptome;
    }

    public function setSymptome(?string $symptome): static
    {
        $this->symptome = $symptome;

        return $this;
    }

    public function getCauses(): ?string
    {
        return $this->causes;
    }

    public function setCauses(?string $causes): static
    {
        $this->causes = $causes;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(?string $traitement): static
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIdAllergie(): ?int
    {
        return $this->idAllergie;
    }

    public function setIdAllergie(?int $idAllergie): static
    {
        $this->idAllergie = $idAllergie;

        return $this;
    }


}
