<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ambitions
 *
 * @ORM\Table(name="ambitions")
 * @ORM\Entity
 */
class Ambition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ambition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAmbition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ambition", type="string", length=50, nullable=true)
     */
    private $ambition;

    public function getIdAmbition(): ?int
    {
        return $this->idAmbition;
    }

    public function getAmbition(): ?string
    {
        return $this->ambition;
    }

    public function setAmbition(?string $ambition): self
    {
        $this->ambition = $ambition;

        return $this;
    }


}
