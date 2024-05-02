<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAllergie
 *
 * @ORM\Table(name="user_allergie", indexes={@ORM\Index(name="allergie_id", columns={"allergie_id"}), @ORM\Index(name="IDX_FE557A4AA76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class UserAllergie
{
    /**
     * @var int
     *
     * @ORM\Column(name="allergie_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $allergieId;

    /**
     * @var \User
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getAllergieId(): ?int
    {
        return $this->allergieId;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }


}
