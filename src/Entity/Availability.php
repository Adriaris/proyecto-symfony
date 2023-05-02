<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Availability
 *
 * @ORM\Table(name="availability")
 * @ORM\Entity
 */
class Availability
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_availability", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvailability;

    /**
     * @var string|null
     *
     * @ORM\Column(name="availability", type="string", length=100, nullable=false)
     */
    private $availability;

    public function getIdAvailability(): ?int
    {
        return $this->idAvailability;
    }

    public function isAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(?string $availability): self
    {
        $this->availability = $availability;

        return $this;
    }




}
