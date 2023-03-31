<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ranks
 *
 * @ORM\Table(name="ranks")
 * @ORM\Entity
 */
class Rank
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rank", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="game_rank", type="string", length=30, nullable=true)
     */
    private $gameRank;

    /**
     * @var int|null
     *
     * @ORM\Column(name="number_rank", type="integer", nullable=true)
     */
    private $numberRank;

    public function getIdRank(): ?int
    {
        return $this->idRank;
    }

    public function getGameRank(): ?string
    {
        return $this->gameRank;
    }

    public function setGameRank(?string $gameRank): self
    {
        $this->gameRank = $gameRank;

        return $this;
    }

    public function getNumberRank(): ?int
    {
        return $this->numberRank;
    }

    public function setNumberRank(?int $numberRank): self
    {
        $this->numberRank = $numberRank;

        return $this;
    }


}
