<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoloRoles
 *
 * @ORM\Table(name="solo_roles")
 * @ORM\Entity
 */
class SoloRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_srole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSrole;

    /**
     * @var string|null
     *
     * @ORM\Column(name="srole", type="string", length=20, nullable=true)
     */
    private $srole;

    public function getIdSrole(): ?int
    {
        return $this->idSrole;
    }

    public function getSrole(): ?string
    {
        return $this->srole;
    }

    public function setSrole(?string $srole): self
    {
        $this->srole = $srole;

        return $this;
    }


}
