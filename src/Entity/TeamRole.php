<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamRoles
 *
 * @ORM\Table(name="team_roles")
 * @ORM\Entity
 */
class TeamRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_trole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTrole;

    /**
     * @var string|null
     *
     * @ORM\Column(name="trole", type="string", length=20, nullable=true)
     */
    private $trole;

    public function getIdTrole(): ?int
    {
        return $this->idTrole;
    }

    public function getTrole(): ?string
    {
        return $this->trole;
    }

    public function setTrole(?string $trole): self
    {
        $this->trole = $trole;

        return $this;
    }


}
