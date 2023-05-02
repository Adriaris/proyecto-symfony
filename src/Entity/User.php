<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="nickname", columns={"nickname"}), @ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="fk_users_team_roles", columns={"id_trole"}), @ORM\Index(name="fk_users_characters3", columns={"id_third_character"}), @ORM\Index(name="fk_users_availability", columns={"id_availability"}), @ORM\Index(name="fk_users_ranks", columns={"id_rank"}), @ORM\Index(name="fk_users_ambitions", columns={"id_ambition"}), @ORM\Index(name="fk_users_characters1", columns={"id_first_character"}), @ORM\Index(name="fk_users_solo_roles", columns={"id_srole"}), @ORM\Index(name="fk_users_characters2", columns={"id_second_character"})})
 * @ORM\Entity
 */
class User implements \JsonSerializable
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
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=40, nullable=false)
     */
    private $nickname;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="age", type="date", nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=100, nullable=false)
     */
    private $nationality;

    /**
     * @var string|null
     *
     * @ORM\Column(name="short_description", type="string", length=200, nullable=true)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="passwd", type="string", length=100, nullable=false)
     */
    private $passwd;

    /**
     * @var \App\Entity\Rank|null
     *
     * @ORM\ManyToOne(targetEntity="Rank")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rank", referencedColumnName="id_rank")
     * })
     */
    private $idRank;

    /**
     * @var \App\Entity\Ambition|null
     *
     * @ORM\ManyToOne(targetEntity="Ambition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ambition", referencedColumnName="id_ambition")
     * })
     */
    private $idAmbition;

    /**
     * @var \App\Entity\Character|null
     *
     * @ORM\ManyToOne(targetEntity="Character")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_second_character", referencedColumnName="id_character")
     * })
     */
    private $idSecondCharacter;

    /**
     * @var \App\Entity\SoloRole|null
     *
     * @ORM\ManyToOne(targetEntity="SoloRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_srole", referencedColumnName="id_srole")
     * })
     */
    private $idSrole;

    /**
     * @var \App\Entity\Availability|null
     *
     * @ORM\ManyToOne(targetEntity="Availability")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_availability", referencedColumnName="id_availability")
     * })
     */
    private $idAvailability;

    /**
     * @var \App\Entity\Character|null
     *
     * @ORM\ManyToOne(targetEntity="Character")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_third_character", referencedColumnName="id_character")
     * })
     */
    private $idThirdCharacter;

    /**
     * @var \App\Entity\TeamRole|null
     *
     * @ORM\ManyToOne(targetEntity="TeamRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trole", referencedColumnName="id_trole")
     * })
     */
    private $idTrole;

    /**
     * @var \App\Entity\Character|null
     *
     * @ORM\ManyToOne(targetEntity="Character")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_first_character", referencedColumnName="id_character")
     * })
     */
    private $idFirstCharacter;



    /**
     * @ORM\ManyToMany(targetEntity="Character")
     * @ORM\JoinTable(name="user_characters",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="character_id", referencedColumnName="id_character")}
     *      )
     */
    private $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getAge(): ?\DateTimeInterface
    {
        return $this->age;
    }

    public function setAge(?\DateTimeInterface $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswd(): ?string
    {
        return $this->passwd;
    }

    public function setPasswd(string $passwd): self
    {
        $this->passwd = $passwd;

        return $this;
    }

    public function getIdRank(): ?Rank
    {
        return $this->idRank;
    }

    public function setIdRank(?Rank $idRank): self
    {
        $this->idRank = $idRank;

        return $this;
    }

    public function getIdAmbition(): ?Ambition
    {
        return $this->idAmbition;
    }

    public function setIdAmbition(?Ambition $idAmbition): self
    {
        $this->idAmbition = $idAmbition;

        return $this;
    }

    public function getIdSecondCharacter(): ?Character
    {
        return $this->idSecondCharacter->getIdCharacter();
    }

    public function setIdSecondCharacter(?Character $idSecondCharacter): self
    {
        $this->idSecondCharacter = $idSecondCharacter;

        return $this;
    }

    public function getIdSrole(): ?SoloRole
    {
        return $this->idSrole;
    }

    public function setIdSrole(?SoloRole $idSrole): self
    {
        $this->idSrole = $idSrole;

        return $this;
    }

    public function getIdAvailability(): ?Availability
    {
        return $this->idAvailability;
    }

    public function setIdAvailability(?Availability $idAvailability): self
    {
        $this->idAvailability = $idAvailability;

        return $this;
    }

    public function getIdThirdCharacter(): ?Character
    {
        return $this->idThirdCharacter->getIdCharacter();
    }

    public function setIdThirdCharacter(?Character $idThirdCharacter): self
    {
        $this->idThirdCharacter = $idThirdCharacter;

        return $this;
    }

    public function getIdTrole(): ?TeamRole
    {
        return $this->idTrole;
    }

    public function setIdTrole(?TeamRole $idTrole): self
    {
        $this->idTrole = $idTrole;

        return $this;
    }

    public function getIdFirstCharacter(): ?Character
    {
        return $this->idFirstCharacter->getIdCharacter();
    }

    public function setIdFirstCharacter(?Character $idFirstCharacter): self
    {
        $this->idFirstCharacter = $idFirstCharacter;

        return $this;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'age' => $this->age,
            'nationality' => $this->nationality,
            'short_description' => $this->shortDescription,
            'email' => $this->email,
            'passwd' => $this->passwd,
            'id_rank' => $this->idRank ? $this->idRank->getIdRank() : null,
            'id_ambition' => $this->idAmbition ? $this->idAmbition->getIdAmbition() : null,
            'id_srole' => $this->idSrole ? $this->idSrole->getIdSrole() : null,
            //'id_availability' => $this->idAvailability,
            'id_trole' => $this->idTrole ? $this->idTrole->getIdTrole() : null,
            'id_first_character' => $this->idFirstCharacter ? $this->idFirstCharacter->getIdCharacter() : null,
            'id_second_character' => $this->idSecondCharacter ? $this->idSecondCharacter->getIdCharacter() : null,
            'id_third_character' => $this->idThirdCharacter ? $this->idThirdCharacter->getIdCharacter() : null,
            //'characters' => $characters
        ];
    }
    
}
