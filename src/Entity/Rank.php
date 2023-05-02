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
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(name="img_rank", type="string", length=200, nullable=true)
     */
    private $imgRank;

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

    public function getImgRank(): ?string
    {
        return $this->imgRank;
    }

    public function setImgRank(?string $imgRank): self
    {
        $this->imgRank = $imgRank;

        return $this;
    }


}
