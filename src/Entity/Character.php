<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Characters
 *
 * @ORM\Table(name="characters", uniqueConstraints={@ORM\UniqueConstraint(name="display_name", columns={"display_name"})})
 * @ORM\Entity
 */
class Character
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_character", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCharacter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="display_name", type="string", length=50, nullable=true)
     */
    private $displayName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="img_character", type="string", length=200, nullable=true)
     */
    private $imgCharacter;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="idFirstCharacter")
     */
    private $usersWithFirstCharacter;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="idSecondCharacter")
     */
    private $usersWithSecondCharacter;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="idThirdCharacter")
     */
    private $usersWithThirdCharacter;

    public function __construct()
    {
        $this->usersWithFirstCharacter = new ArrayCollection();
        $this->usersWithSecondCharacter = new ArrayCollection();
        $this->usersWithThirdCharacter = new ArrayCollection();
    }

    public function getIdCharacter(): ?int
    {
        return $this->idCharacter;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getImgCharacter(): ?string
    {
        return $this->imgCharacter;
    }

    public function setImgCharacter(?string $imgCharacter): self
    {
        $this->imgCharacter = $imgCharacter;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersWithFirstCharacter(): Collection
    {
        return $this->usersWithFirstCharacter;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersWithSecondCharacter(): Collection
    {
        return $this->usersWithSecondCharacter;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersWithThirdCharacter(): Collection
    {
        return $this->usersWithThirdCharacter;
    }
}
