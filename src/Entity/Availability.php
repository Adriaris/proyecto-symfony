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
     * @var bool|null
     *
     * @ORM\Column(name="monday_00", type="boolean", nullable=true)
     */
    private $monday00;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_01", type="boolean", nullable=true)
     */
    private $monday01;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_02", type="boolean", nullable=true)
     */
    private $monday02;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_03", type="boolean", nullable=true)
     */
    private $monday03;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_04", type="boolean", nullable=true)
     */
    private $monday04;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_05", type="boolean", nullable=true)
     */
    private $monday05;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_06", type="boolean", nullable=true)
     */
    private $monday06;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_07", type="boolean", nullable=true)
     */
    private $monday07;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_08", type="boolean", nullable=true)
     */
    private $monday08;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_09", type="boolean", nullable=true)
     */
    private $monday09;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_10", type="boolean", nullable=true)
     */
    private $monday10;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_11", type="boolean", nullable=true)
     */
    private $monday11;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_12", type="boolean", nullable=true)
     */
    private $monday12;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_13", type="boolean", nullable=true)
     */
    private $monday13;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_14", type="boolean", nullable=true)
     */
    private $monday14;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_15", type="boolean", nullable=true)
     */
    private $monday15;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_16", type="boolean", nullable=true)
     */
    private $monday16;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_17", type="boolean", nullable=true)
     */
    private $monday17;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_18", type="boolean", nullable=true)
     */
    private $monday18;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_19", type="boolean", nullable=true)
     */
    private $monday19;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_20", type="boolean", nullable=true)
     */
    private $monday20;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_21", type="boolean", nullable=true)
     */
    private $monday21;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_22", type="boolean", nullable=true)
     */
    private $monday22;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="monday_23", type="boolean", nullable=true)
     */
    private $monday23;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_00", type="boolean", nullable=true)
     */
    private $tuesday00;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_01", type="boolean", nullable=true)
     */
    private $tuesday01;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_02", type="boolean", nullable=true)
     */
    private $tuesday02;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_03", type="boolean", nullable=true)
     */
    private $tuesday03;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_04", type="boolean", nullable=true)
     */
    private $tuesday04;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_05", type="boolean", nullable=true)
     */
    private $tuesday05;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_06", type="boolean", nullable=true)
     */
    private $tuesday06;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_07", type="boolean", nullable=true)
     */
    private $tuesday07;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_08", type="boolean", nullable=true)
     */
    private $tuesday08;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_09", type="boolean", nullable=true)
     */
    private $tuesday09;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_10", type="boolean", nullable=true)
     */
    private $tuesday10;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_11", type="boolean", nullable=true)
     */
    private $tuesday11;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_12", type="boolean", nullable=true)
     */
    private $tuesday12;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_13", type="boolean", nullable=true)
     */
    private $tuesday13;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_14", type="boolean", nullable=true)
     */
    private $tuesday14;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_15", type="boolean", nullable=true)
     */
    private $tuesday15;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_16", type="boolean", nullable=true)
     */
    private $tuesday16;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_17", type="boolean", nullable=true)
     */
    private $tuesday17;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_18", type="boolean", nullable=true)
     */
    private $tuesday18;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_19", type="boolean", nullable=true)
     */
    private $tuesday19;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_20", type="boolean", nullable=true)
     */
    private $tuesday20;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_21", type="boolean", nullable=true)
     */
    private $tuesday21;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_22", type="boolean", nullable=true)
     */
    private $tuesday22;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="tuesday_23", type="boolean", nullable=true)
     */
    private $tuesday23;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_00", type="boolean", nullable=true)
     */
    private $wednesday00;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_01", type="boolean", nullable=true)
     */
    private $wednesday01;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_02", type="boolean", nullable=true)
     */
    private $wednesday02;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_03", type="boolean", nullable=true)
     */
    private $wednesday03;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_04", type="boolean", nullable=true)
     */
    private $wednesday04;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_05", type="boolean", nullable=true)
     */
    private $wednesday05;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_06", type="boolean", nullable=true)
     */
    private $wednesday06;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_07", type="boolean", nullable=true)
     */
    private $wednesday07;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_08", type="boolean", nullable=true)
     */
    private $wednesday08;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_09", type="boolean", nullable=true)
     */
    private $wednesday09;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_10", type="boolean", nullable=true)
     */
    private $wednesday10;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_11", type="boolean", nullable=true)
     */
    private $wednesday11;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_12", type="boolean", nullable=true)
     */
    private $wednesday12;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_13", type="boolean", nullable=true)
     */
    private $wednesday13;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_14", type="boolean", nullable=true)
     */
    private $wednesday14;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_15", type="boolean", nullable=true)
     */
    private $wednesday15;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_16", type="boolean", nullable=true)
     */
    private $wednesday16;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_17", type="boolean", nullable=true)
     */
    private $wednesday17;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_18", type="boolean", nullable=true)
     */
    private $wednesday18;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_19", type="boolean", nullable=true)
     */
    private $wednesday19;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_20", type="boolean", nullable=true)
     */
    private $wednesday20;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_21", type="boolean", nullable=true)
     */
    private $wednesday21;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_22", type="boolean", nullable=true)
     */
    private $wednesday22;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wednesday_23", type="boolean", nullable=true)
     */
    private $wednesday23;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_00", type="boolean", nullable=true)
     */
    private $thursday00;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_01", type="boolean", nullable=true)
     */
    private $thursday01;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_02", type="boolean", nullable=true)
     */
    private $thursday02;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_03", type="boolean", nullable=true)
     */
    private $thursday03;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_04", type="boolean", nullable=true)
     */
    private $thursday04;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_05", type="boolean", nullable=true)
     */
    private $thursday05;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_06", type="boolean", nullable=true)
     */
    private $thursday06;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_07", type="boolean", nullable=true)
     */
    private $thursday07;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_08", type="boolean", nullable=true)
     */
    private $thursday08;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_09", type="boolean", nullable=true)
     */
    private $thursday09;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_10", type="boolean", nullable=true)
     */
    private $thursday10;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_11", type="boolean", nullable=true)
     */
    private $thursday11;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_12", type="boolean", nullable=true)
     */
    private $thursday12;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_13", type="boolean", nullable=true)
     */
    private $thursday13;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_14", type="boolean", nullable=true)
     */
    private $thursday14;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_15", type="boolean", nullable=true)
     */
    private $thursday15;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_16", type="boolean", nullable=true)
     */
    private $thursday16;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_17", type="boolean", nullable=true)
     */
    private $thursday17;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_18", type="boolean", nullable=true)
     */
    private $thursday18;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_19", type="boolean", nullable=true)
     */
    private $thursday19;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_20", type="boolean", nullable=true)
     */
    private $thursday20;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_21", type="boolean", nullable=true)
     */
    private $thursday21;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_22", type="boolean", nullable=true)
     */
    private $thursday22;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="thursday_23", type="boolean", nullable=true)
     */
    private $thursday23;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_00", type="boolean", nullable=true)
     */
    private $friday00;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_01", type="boolean", nullable=true)
     */
    private $friday01;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_02", type="boolean", nullable=true)
     */
    private $friday02;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_03", type="boolean", nullable=true)
     */
    private $friday03;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_04", type="boolean", nullable=true)
     */
    private $friday04;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_05", type="boolean", nullable=true)
     */
    private $friday05;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_06", type="boolean", nullable=true)
     */
    private $friday06;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_07", type="boolean", nullable=true)
     */
    private $friday07;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_08", type="boolean", nullable=true)
     */
    private $friday08;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_09", type="boolean", nullable=true)
     */
    private $friday09;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_10", type="boolean", nullable=true)
     */
    private $friday10;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_11", type="boolean", nullable=true)
     */
    private $friday11;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_12", type="boolean", nullable=true)
     */
    private $friday12;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_13", type="boolean", nullable=true)
     */
    private $friday13;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_14", type="boolean", nullable=true)
     */
    private $friday14;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_15", type="boolean", nullable=true)
     */
    private $friday15;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_16", type="boolean", nullable=true)
     */
    private $friday16;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_17", type="boolean", nullable=true)
     */
    private $friday17;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_18", type="boolean", nullable=true)
     */
    private $friday18;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_19", type="boolean", nullable=true)
     */
    private $friday19;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_20", type="boolean", nullable=true)
     */
    private $friday20;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_21", type="boolean", nullable=true)
     */
    private $friday21;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_22", type="boolean", nullable=true)
     */
    private $friday22;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="friday_23", type="boolean", nullable=true)
     */
    private $friday23;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_00", type="boolean", nullable=true)
     */
    private $saturday00;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_01", type="boolean", nullable=true)
     */
    private $saturday01;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_02", type="boolean", nullable=true)
     */
    private $saturday02;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_03", type="boolean", nullable=true)
     */
    private $saturday03;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_04", type="boolean", nullable=true)
     */
    private $saturday04;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_05", type="boolean", nullable=true)
     */
    private $saturday05;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_06", type="boolean", nullable=true)
     */
    private $saturday06;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_07", type="boolean", nullable=true)
     */
    private $saturday07;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_08", type="boolean", nullable=true)
     */
    private $saturday08;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_09", type="boolean", nullable=true)
     */
    private $saturday09;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_10", type="boolean", nullable=true)
     */
    private $saturday10;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_11", type="boolean", nullable=true)
     */
    private $saturday11;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_12", type="boolean", nullable=true)
     */
    private $saturday12;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_13", type="boolean", nullable=true)
     */
    private $saturday13;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_14", type="boolean", nullable=true)
     */
    private $saturday14;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_15", type="boolean", nullable=true)
     */
    private $saturday15;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_16", type="boolean", nullable=true)
     */
    private $saturday16;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_17", type="boolean", nullable=true)
     */
    private $saturday17;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_18", type="boolean", nullable=true)
     */
    private $saturday18;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_19", type="boolean", nullable=true)
     */
    private $saturday19;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_20", type="boolean", nullable=true)
     */
    private $saturday20;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_21", type="boolean", nullable=true)
     */
    private $saturday21;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_22", type="boolean", nullable=true)
     */
    private $saturday22;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="saturday_23", type="boolean", nullable=true)
     */
    private $saturday23;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_00", type="boolean", nullable=true)
     */
    private $sunday00;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_01", type="boolean", nullable=true)
     */
    private $sunday01;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_02", type="boolean", nullable=true)
     */
    private $sunday02;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_03", type="boolean", nullable=true)
     */
    private $sunday03;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_04", type="boolean", nullable=true)
     */
    private $sunday04;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_05", type="boolean", nullable=true)
     */
    private $sunday05;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_06", type="boolean", nullable=true)
     */
    private $sunday06;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_07", type="boolean", nullable=true)
     */
    private $sunday07;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_08", type="boolean", nullable=true)
     */
    private $sunday08;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_09", type="boolean", nullable=true)
     */
    private $sunday09;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_10", type="boolean", nullable=true)
     */
    private $sunday10;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_11", type="boolean", nullable=true)
     */
    private $sunday11;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_12", type="boolean", nullable=true)
     */
    private $sunday12;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_13", type="boolean", nullable=true)
     */
    private $sunday13;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_14", type="boolean", nullable=true)
     */
    private $sunday14;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_15", type="boolean", nullable=true)
     */
    private $sunday15;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_16", type="boolean", nullable=true)
     */
    private $sunday16;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_17", type="boolean", nullable=true)
     */
    private $sunday17;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_18", type="boolean", nullable=true)
     */
    private $sunday18;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_19", type="boolean", nullable=true)
     */
    private $sunday19;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_20", type="boolean", nullable=true)
     */
    private $sunday20;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_21", type="boolean", nullable=true)
     */
    private $sunday21;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_22", type="boolean", nullable=true)
     */
    private $sunday22;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sunday_23", type="boolean", nullable=true)
     */
    private $sunday23;

    public function getIdAvailability(): ?int
    {
        return $this->idAvailability;
    }

    public function isMonday00(): ?bool
    {
        return $this->monday00;
    }

    public function setMonday00(?bool $monday00): self
    {
        $this->monday00 = $monday00;

        return $this;
    }

    public function isMonday01(): ?bool
    {
        return $this->monday01;
    }

    public function setMonday01(?bool $monday01): self
    {
        $this->monday01 = $monday01;

        return $this;
    }

    public function isMonday02(): ?bool
    {
        return $this->monday02;
    }

    public function setMonday02(?bool $monday02): self
    {
        $this->monday02 = $monday02;

        return $this;
    }

    public function isMonday03(): ?bool
    {
        return $this->monday03;
    }

    public function setMonday03(?bool $monday03): self
    {
        $this->monday03 = $monday03;

        return $this;
    }

    public function isMonday04(): ?bool
    {
        return $this->monday04;
    }

    public function setMonday04(?bool $monday04): self
    {
        $this->monday04 = $monday04;

        return $this;
    }

    public function isMonday05(): ?bool
    {
        return $this->monday05;
    }

    public function setMonday05(?bool $monday05): self
    {
        $this->monday05 = $monday05;

        return $this;
    }

    public function isMonday06(): ?bool
    {
        return $this->monday06;
    }

    public function setMonday06(?bool $monday06): self
    {
        $this->monday06 = $monday06;

        return $this;
    }

    public function isMonday07(): ?bool
    {
        return $this->monday07;
    }

    public function setMonday07(?bool $monday07): self
    {
        $this->monday07 = $monday07;

        return $this;
    }

    public function isMonday08(): ?bool
    {
        return $this->monday08;
    }

    public function setMonday08(?bool $monday08): self
    {
        $this->monday08 = $monday08;

        return $this;
    }

    public function isMonday09(): ?bool
    {
        return $this->monday09;
    }

    public function setMonday09(?bool $monday09): self
    {
        $this->monday09 = $monday09;

        return $this;
    }

    public function isMonday10(): ?bool
    {
        return $this->monday10;
    }

    public function setMonday10(?bool $monday10): self
    {
        $this->monday10 = $monday10;

        return $this;
    }

    public function isMonday11(): ?bool
    {
        return $this->monday11;
    }

    public function setMonday11(?bool $monday11): self
    {
        $this->monday11 = $monday11;

        return $this;
    }

    public function isMonday12(): ?bool
    {
        return $this->monday12;
    }

    public function setMonday12(?bool $monday12): self
    {
        $this->monday12 = $monday12;

        return $this;
    }

    public function isMonday13(): ?bool
    {
        return $this->monday13;
    }

    public function setMonday13(?bool $monday13): self
    {
        $this->monday13 = $monday13;

        return $this;
    }

    public function isMonday14(): ?bool
    {
        return $this->monday14;
    }

    public function setMonday14(?bool $monday14): self
    {
        $this->monday14 = $monday14;

        return $this;
    }

    public function isMonday15(): ?bool
    {
        return $this->monday15;
    }

    public function setMonday15(?bool $monday15): self
    {
        $this->monday15 = $monday15;

        return $this;
    }

    public function isMonday16(): ?bool
    {
        return $this->monday16;
    }

    public function setMonday16(?bool $monday16): self
    {
        $this->monday16 = $monday16;

        return $this;
    }

    public function isMonday17(): ?bool
    {
        return $this->monday17;
    }

    public function setMonday17(?bool $monday17): self
    {
        $this->monday17 = $monday17;

        return $this;
    }

    public function isMonday18(): ?bool
    {
        return $this->monday18;
    }

    public function setMonday18(?bool $monday18): self
    {
        $this->monday18 = $monday18;

        return $this;
    }

    public function isMonday19(): ?bool
    {
        return $this->monday19;
    }

    public function setMonday19(?bool $monday19): self
    {
        $this->monday19 = $monday19;

        return $this;
    }

    public function isMonday20(): ?bool
    {
        return $this->monday20;
    }

    public function setMonday20(?bool $monday20): self
    {
        $this->monday20 = $monday20;

        return $this;
    }

    public function isMonday21(): ?bool
    {
        return $this->monday21;
    }

    public function setMonday21(?bool $monday21): self
    {
        $this->monday21 = $monday21;

        return $this;
    }

    public function isMonday22(): ?bool
    {
        return $this->monday22;
    }

    public function setMonday22(?bool $monday22): self
    {
        $this->monday22 = $monday22;

        return $this;
    }

    public function isMonday23(): ?bool
    {
        return $this->monday23;
    }

    public function setMonday23(?bool $monday23): self
    {
        $this->monday23 = $monday23;

        return $this;
    }

    public function isTuesday00(): ?bool
    {
        return $this->tuesday00;
    }

    public function setTuesday00(?bool $tuesday00): self
    {
        $this->tuesday00 = $tuesday00;

        return $this;
    }

    public function isTuesday01(): ?bool
    {
        return $this->tuesday01;
    }

    public function setTuesday01(?bool $tuesday01): self
    {
        $this->tuesday01 = $tuesday01;

        return $this;
    }

    public function isTuesday02(): ?bool
    {
        return $this->tuesday02;
    }

    public function setTuesday02(?bool $tuesday02): self
    {
        $this->tuesday02 = $tuesday02;

        return $this;
    }

    public function isTuesday03(): ?bool
    {
        return $this->tuesday03;
    }

    public function setTuesday03(?bool $tuesday03): self
    {
        $this->tuesday03 = $tuesday03;

        return $this;
    }

    public function isTuesday04(): ?bool
    {
        return $this->tuesday04;
    }

    public function setTuesday04(?bool $tuesday04): self
    {
        $this->tuesday04 = $tuesday04;

        return $this;
    }

    public function isTuesday05(): ?bool
    {
        return $this->tuesday05;
    }

    public function setTuesday05(?bool $tuesday05): self
    {
        $this->tuesday05 = $tuesday05;

        return $this;
    }

    public function isTuesday06(): ?bool
    {
        return $this->tuesday06;
    }

    public function setTuesday06(?bool $tuesday06): self
    {
        $this->tuesday06 = $tuesday06;

        return $this;
    }

    public function isTuesday07(): ?bool
    {
        return $this->tuesday07;
    }

    public function setTuesday07(?bool $tuesday07): self
    {
        $this->tuesday07 = $tuesday07;

        return $this;
    }

    public function isTuesday08(): ?bool
    {
        return $this->tuesday08;
    }

    public function setTuesday08(?bool $tuesday08): self
    {
        $this->tuesday08 = $tuesday08;

        return $this;
    }

    public function isTuesday09(): ?bool
    {
        return $this->tuesday09;
    }

    public function setTuesday09(?bool $tuesday09): self
    {
        $this->tuesday09 = $tuesday09;

        return $this;
    }

    public function isTuesday10(): ?bool
    {
        return $this->tuesday10;
    }

    public function setTuesday10(?bool $tuesday10): self
    {
        $this->tuesday10 = $tuesday10;

        return $this;
    }

    public function isTuesday11(): ?bool
    {
        return $this->tuesday11;
    }

    public function setTuesday11(?bool $tuesday11): self
    {
        $this->tuesday11 = $tuesday11;

        return $this;
    }

    public function isTuesday12(): ?bool
    {
        return $this->tuesday12;
    }

    public function setTuesday12(?bool $tuesday12): self
    {
        $this->tuesday12 = $tuesday12;

        return $this;
    }

    public function isTuesday13(): ?bool
    {
        return $this->tuesday13;
    }

    public function setTuesday13(?bool $tuesday13): self
    {
        $this->tuesday13 = $tuesday13;

        return $this;
    }

    public function isTuesday14(): ?bool
    {
        return $this->tuesday14;
    }

    public function setTuesday14(?bool $tuesday14): self
    {
        $this->tuesday14 = $tuesday14;

        return $this;
    }

    public function isTuesday15(): ?bool
    {
        return $this->tuesday15;
    }

    public function setTuesday15(?bool $tuesday15): self
    {
        $this->tuesday15 = $tuesday15;

        return $this;
    }

    public function isTuesday16(): ?bool
    {
        return $this->tuesday16;
    }

    public function setTuesday16(?bool $tuesday16): self
    {
        $this->tuesday16 = $tuesday16;

        return $this;
    }

    public function isTuesday17(): ?bool
    {
        return $this->tuesday17;
    }

    public function setTuesday17(?bool $tuesday17): self
    {
        $this->tuesday17 = $tuesday17;

        return $this;
    }

    public function isTuesday18(): ?bool
    {
        return $this->tuesday18;
    }

    public function setTuesday18(?bool $tuesday18): self
    {
        $this->tuesday18 = $tuesday18;

        return $this;
    }

    public function isTuesday19(): ?bool
    {
        return $this->tuesday19;
    }

    public function setTuesday19(?bool $tuesday19): self
    {
        $this->tuesday19 = $tuesday19;

        return $this;
    }

    public function isTuesday20(): ?bool
    {
        return $this->tuesday20;
    }

    public function setTuesday20(?bool $tuesday20): self
    {
        $this->tuesday20 = $tuesday20;

        return $this;
    }

    public function isTuesday21(): ?bool
    {
        return $this->tuesday21;
    }

    public function setTuesday21(?bool $tuesday21): self
    {
        $this->tuesday21 = $tuesday21;

        return $this;
    }

    public function isTuesday22(): ?bool
    {
        return $this->tuesday22;
    }

    public function setTuesday22(?bool $tuesday22): self
    {
        $this->tuesday22 = $tuesday22;

        return $this;
    }

    public function isTuesday23(): ?bool
    {
        return $this->tuesday23;
    }

    public function setTuesday23(?bool $tuesday23): self
    {
        $this->tuesday23 = $tuesday23;

        return $this;
    }

    public function isWednesday00(): ?bool
    {
        return $this->wednesday00;
    }

    public function setWednesday00(?bool $wednesday00): self
    {
        $this->wednesday00 = $wednesday00;

        return $this;
    }

    public function isWednesday01(): ?bool
    {
        return $this->wednesday01;
    }

    public function setWednesday01(?bool $wednesday01): self
    {
        $this->wednesday01 = $wednesday01;

        return $this;
    }

    public function isWednesday02(): ?bool
    {
        return $this->wednesday02;
    }

    public function setWednesday02(?bool $wednesday02): self
    {
        $this->wednesday02 = $wednesday02;

        return $this;
    }

    public function isWednesday03(): ?bool
    {
        return $this->wednesday03;
    }

    public function setWednesday03(?bool $wednesday03): self
    {
        $this->wednesday03 = $wednesday03;

        return $this;
    }

    public function isWednesday04(): ?bool
    {
        return $this->wednesday04;
    }

    public function setWednesday04(?bool $wednesday04): self
    {
        $this->wednesday04 = $wednesday04;

        return $this;
    }

    public function isWednesday05(): ?bool
    {
        return $this->wednesday05;
    }

    public function setWednesday05(?bool $wednesday05): self
    {
        $this->wednesday05 = $wednesday05;

        return $this;
    }

    public function isWednesday06(): ?bool
    {
        return $this->wednesday06;
    }

    public function setWednesday06(?bool $wednesday06): self
    {
        $this->wednesday06 = $wednesday06;

        return $this;
    }

    public function isWednesday07(): ?bool
    {
        return $this->wednesday07;
    }

    public function setWednesday07(?bool $wednesday07): self
    {
        $this->wednesday07 = $wednesday07;

        return $this;
    }

    public function isWednesday08(): ?bool
    {
        return $this->wednesday08;
    }

    public function setWednesday08(?bool $wednesday08): self
    {
        $this->wednesday08 = $wednesday08;

        return $this;
    }

    public function isWednesday09(): ?bool
    {
        return $this->wednesday09;
    }

    public function setWednesday09(?bool $wednesday09): self
    {
        $this->wednesday09 = $wednesday09;

        return $this;
    }

    public function isWednesday10(): ?bool
    {
        return $this->wednesday10;
    }

    public function setWednesday10(?bool $wednesday10): self
    {
        $this->wednesday10 = $wednesday10;

        return $this;
    }

    public function isWednesday11(): ?bool
    {
        return $this->wednesday11;
    }

    public function setWednesday11(?bool $wednesday11): self
    {
        $this->wednesday11 = $wednesday11;

        return $this;
    }

    public function isWednesday12(): ?bool
    {
        return $this->wednesday12;
    }

    public function setWednesday12(?bool $wednesday12): self
    {
        $this->wednesday12 = $wednesday12;

        return $this;
    }

    public function isWednesday13(): ?bool
    {
        return $this->wednesday13;
    }

    public function setWednesday13(?bool $wednesday13): self
    {
        $this->wednesday13 = $wednesday13;

        return $this;
    }

    public function isWednesday14(): ?bool
    {
        return $this->wednesday14;
    }

    public function setWednesday14(?bool $wednesday14): self
    {
        $this->wednesday14 = $wednesday14;

        return $this;
    }

    public function isWednesday15(): ?bool
    {
        return $this->wednesday15;
    }

    public function setWednesday15(?bool $wednesday15): self
    {
        $this->wednesday15 = $wednesday15;

        return $this;
    }

    public function isWednesday16(): ?bool
    {
        return $this->wednesday16;
    }

    public function setWednesday16(?bool $wednesday16): self
    {
        $this->wednesday16 = $wednesday16;

        return $this;
    }

    public function isWednesday17(): ?bool
    {
        return $this->wednesday17;
    }

    public function setWednesday17(?bool $wednesday17): self
    {
        $this->wednesday17 = $wednesday17;

        return $this;
    }

    public function isWednesday18(): ?bool
    {
        return $this->wednesday18;
    }

    public function setWednesday18(?bool $wednesday18): self
    {
        $this->wednesday18 = $wednesday18;

        return $this;
    }

    public function isWednesday19(): ?bool
    {
        return $this->wednesday19;
    }

    public function setWednesday19(?bool $wednesday19): self
    {
        $this->wednesday19 = $wednesday19;

        return $this;
    }

    public function isWednesday20(): ?bool
    {
        return $this->wednesday20;
    }

    public function setWednesday20(?bool $wednesday20): self
    {
        $this->wednesday20 = $wednesday20;

        return $this;
    }

    public function isWednesday21(): ?bool
    {
        return $this->wednesday21;
    }

    public function setWednesday21(?bool $wednesday21): self
    {
        $this->wednesday21 = $wednesday21;

        return $this;
    }

    public function isWednesday22(): ?bool
    {
        return $this->wednesday22;
    }

    public function setWednesday22(?bool $wednesday22): self
    {
        $this->wednesday22 = $wednesday22;

        return $this;
    }

    public function isWednesday23(): ?bool
    {
        return $this->wednesday23;
    }

    public function setWednesday23(?bool $wednesday23): self
    {
        $this->wednesday23 = $wednesday23;

        return $this;
    }

    public function isThursday00(): ?bool
    {
        return $this->thursday00;
    }

    public function setThursday00(?bool $thursday00): self
    {
        $this->thursday00 = $thursday00;

        return $this;
    }

    public function isThursday01(): ?bool
    {
        return $this->thursday01;
    }

    public function setThursday01(?bool $thursday01): self
    {
        $this->thursday01 = $thursday01;

        return $this;
    }

    public function isThursday02(): ?bool
    {
        return $this->thursday02;
    }

    public function setThursday02(?bool $thursday02): self
    {
        $this->thursday02 = $thursday02;

        return $this;
    }

    public function isThursday03(): ?bool
    {
        return $this->thursday03;
    }

    public function setThursday03(?bool $thursday03): self
    {
        $this->thursday03 = $thursday03;

        return $this;
    }

    public function isThursday04(): ?bool
    {
        return $this->thursday04;
    }

    public function setThursday04(?bool $thursday04): self
    {
        $this->thursday04 = $thursday04;

        return $this;
    }

    public function isThursday05(): ?bool
    {
        return $this->thursday05;
    }

    public function setThursday05(?bool $thursday05): self
    {
        $this->thursday05 = $thursday05;

        return $this;
    }

    public function isThursday06(): ?bool
    {
        return $this->thursday06;
    }

    public function setThursday06(?bool $thursday06): self
    {
        $this->thursday06 = $thursday06;

        return $this;
    }

    public function isThursday07(): ?bool
    {
        return $this->thursday07;
    }

    public function setThursday07(?bool $thursday07): self
    {
        $this->thursday07 = $thursday07;

        return $this;
    }

    public function isThursday08(): ?bool
    {
        return $this->thursday08;
    }

    public function setThursday08(?bool $thursday08): self
    {
        $this->thursday08 = $thursday08;

        return $this;
    }

    public function isThursday09(): ?bool
    {
        return $this->thursday09;
    }

    public function setThursday09(?bool $thursday09): self
    {
        $this->thursday09 = $thursday09;

        return $this;
    }

    public function isThursday10(): ?bool
    {
        return $this->thursday10;
    }

    public function setThursday10(?bool $thursday10): self
    {
        $this->thursday10 = $thursday10;

        return $this;
    }

    public function isThursday11(): ?bool
    {
        return $this->thursday11;
    }

    public function setThursday11(?bool $thursday11): self
    {
        $this->thursday11 = $thursday11;

        return $this;
    }

    public function isThursday12(): ?bool
    {
        return $this->thursday12;
    }

    public function setThursday12(?bool $thursday12): self
    {
        $this->thursday12 = $thursday12;

        return $this;
    }

    public function isThursday13(): ?bool
    {
        return $this->thursday13;
    }

    public function setThursday13(?bool $thursday13): self
    {
        $this->thursday13 = $thursday13;

        return $this;
    }

    public function isThursday14(): ?bool
    {
        return $this->thursday14;
    }

    public function setThursday14(?bool $thursday14): self
    {
        $this->thursday14 = $thursday14;

        return $this;
    }

    public function isThursday15(): ?bool
    {
        return $this->thursday15;
    }

    public function setThursday15(?bool $thursday15): self
    {
        $this->thursday15 = $thursday15;

        return $this;
    }

    public function isThursday16(): ?bool
    {
        return $this->thursday16;
    }

    public function setThursday16(?bool $thursday16): self
    {
        $this->thursday16 = $thursday16;

        return $this;
    }

    public function isThursday17(): ?bool
    {
        return $this->thursday17;
    }

    public function setThursday17(?bool $thursday17): self
    {
        $this->thursday17 = $thursday17;

        return $this;
    }

    public function isThursday18(): ?bool
    {
        return $this->thursday18;
    }

    public function setThursday18(?bool $thursday18): self
    {
        $this->thursday18 = $thursday18;

        return $this;
    }

    public function isThursday19(): ?bool
    {
        return $this->thursday19;
    }

    public function setThursday19(?bool $thursday19): self
    {
        $this->thursday19 = $thursday19;

        return $this;
    }

    public function isThursday20(): ?bool
    {
        return $this->thursday20;
    }

    public function setThursday20(?bool $thursday20): self
    {
        $this->thursday20 = $thursday20;

        return $this;
    }

    public function isThursday21(): ?bool
    {
        return $this->thursday21;
    }

    public function setThursday21(?bool $thursday21): self
    {
        $this->thursday21 = $thursday21;

        return $this;
    }

    public function isThursday22(): ?bool
    {
        return $this->thursday22;
    }

    public function setThursday22(?bool $thursday22): self
    {
        $this->thursday22 = $thursday22;

        return $this;
    }

    public function isThursday23(): ?bool
    {
        return $this->thursday23;
    }

    public function setThursday23(?bool $thursday23): self
    {
        $this->thursday23 = $thursday23;

        return $this;
    }

    public function isFriday00(): ?bool
    {
        return $this->friday00;
    }

    public function setFriday00(?bool $friday00): self
    {
        $this->friday00 = $friday00;

        return $this;
    }

    public function isFriday01(): ?bool
    {
        return $this->friday01;
    }

    public function setFriday01(?bool $friday01): self
    {
        $this->friday01 = $friday01;

        return $this;
    }

    public function isFriday02(): ?bool
    {
        return $this->friday02;
    }

    public function setFriday02(?bool $friday02): self
    {
        $this->friday02 = $friday02;

        return $this;
    }

    public function isFriday03(): ?bool
    {
        return $this->friday03;
    }

    public function setFriday03(?bool $friday03): self
    {
        $this->friday03 = $friday03;

        return $this;
    }

    public function isFriday04(): ?bool
    {
        return $this->friday04;
    }

    public function setFriday04(?bool $friday04): self
    {
        $this->friday04 = $friday04;

        return $this;
    }

    public function isFriday05(): ?bool
    {
        return $this->friday05;
    }

    public function setFriday05(?bool $friday05): self
    {
        $this->friday05 = $friday05;

        return $this;
    }

    public function isFriday06(): ?bool
    {
        return $this->friday06;
    }

    public function setFriday06(?bool $friday06): self
    {
        $this->friday06 = $friday06;

        return $this;
    }

    public function isFriday07(): ?bool
    {
        return $this->friday07;
    }

    public function setFriday07(?bool $friday07): self
    {
        $this->friday07 = $friday07;

        return $this;
    }

    public function isFriday08(): ?bool
    {
        return $this->friday08;
    }

    public function setFriday08(?bool $friday08): self
    {
        $this->friday08 = $friday08;

        return $this;
    }

    public function isFriday09(): ?bool
    {
        return $this->friday09;
    }

    public function setFriday09(?bool $friday09): self
    {
        $this->friday09 = $friday09;

        return $this;
    }

    public function isFriday10(): ?bool
    {
        return $this->friday10;
    }

    public function setFriday10(?bool $friday10): self
    {
        $this->friday10 = $friday10;

        return $this;
    }

    public function isFriday11(): ?bool
    {
        return $this->friday11;
    }

    public function setFriday11(?bool $friday11): self
    {
        $this->friday11 = $friday11;

        return $this;
    }

    public function isFriday12(): ?bool
    {
        return $this->friday12;
    }

    public function setFriday12(?bool $friday12): self
    {
        $this->friday12 = $friday12;

        return $this;
    }

    public function isFriday13(): ?bool
    {
        return $this->friday13;
    }

    public function setFriday13(?bool $friday13): self
    {
        $this->friday13 = $friday13;

        return $this;
    }

    public function isFriday14(): ?bool
    {
        return $this->friday14;
    }

    public function setFriday14(?bool $friday14): self
    {
        $this->friday14 = $friday14;

        return $this;
    }

    public function isFriday15(): ?bool
    {
        return $this->friday15;
    }

    public function setFriday15(?bool $friday15): self
    {
        $this->friday15 = $friday15;

        return $this;
    }

    public function isFriday16(): ?bool
    {
        return $this->friday16;
    }

    public function setFriday16(?bool $friday16): self
    {
        $this->friday16 = $friday16;

        return $this;
    }

    public function isFriday17(): ?bool
    {
        return $this->friday17;
    }

    public function setFriday17(?bool $friday17): self
    {
        $this->friday17 = $friday17;

        return $this;
    }

    public function isFriday18(): ?bool
    {
        return $this->friday18;
    }

    public function setFriday18(?bool $friday18): self
    {
        $this->friday18 = $friday18;

        return $this;
    }

    public function isFriday19(): ?bool
    {
        return $this->friday19;
    }

    public function setFriday19(?bool $friday19): self
    {
        $this->friday19 = $friday19;

        return $this;
    }

    public function isFriday20(): ?bool
    {
        return $this->friday20;
    }

    public function setFriday20(?bool $friday20): self
    {
        $this->friday20 = $friday20;

        return $this;
    }

    public function isFriday21(): ?bool
    {
        return $this->friday21;
    }

    public function setFriday21(?bool $friday21): self
    {
        $this->friday21 = $friday21;

        return $this;
    }

    public function isFriday22(): ?bool
    {
        return $this->friday22;
    }

    public function setFriday22(?bool $friday22): self
    {
        $this->friday22 = $friday22;

        return $this;
    }

    public function isFriday23(): ?bool
    {
        return $this->friday23;
    }

    public function setFriday23(?bool $friday23): self
    {
        $this->friday23 = $friday23;

        return $this;
    }

    public function isSaturday00(): ?bool
    {
        return $this->saturday00;
    }

    public function setSaturday00(?bool $saturday00): self
    {
        $this->saturday00 = $saturday00;

        return $this;
    }

    public function isSaturday01(): ?bool
    {
        return $this->saturday01;
    }

    public function setSaturday01(?bool $saturday01): self
    {
        $this->saturday01 = $saturday01;

        return $this;
    }

    public function isSaturday02(): ?bool
    {
        return $this->saturday02;
    }

    public function setSaturday02(?bool $saturday02): self
    {
        $this->saturday02 = $saturday02;

        return $this;
    }

    public function isSaturday03(): ?bool
    {
        return $this->saturday03;
    }

    public function setSaturday03(?bool $saturday03): self
    {
        $this->saturday03 = $saturday03;

        return $this;
    }

    public function isSaturday04(): ?bool
    {
        return $this->saturday04;
    }

    public function setSaturday04(?bool $saturday04): self
    {
        $this->saturday04 = $saturday04;

        return $this;
    }

    public function isSaturday05(): ?bool
    {
        return $this->saturday05;
    }

    public function setSaturday05(?bool $saturday05): self
    {
        $this->saturday05 = $saturday05;

        return $this;
    }

    public function isSaturday06(): ?bool
    {
        return $this->saturday06;
    }

    public function setSaturday06(?bool $saturday06): self
    {
        $this->saturday06 = $saturday06;

        return $this;
    }

    public function isSaturday07(): ?bool
    {
        return $this->saturday07;
    }

    public function setSaturday07(?bool $saturday07): self
    {
        $this->saturday07 = $saturday07;

        return $this;
    }

    public function isSaturday08(): ?bool
    {
        return $this->saturday08;
    }

    public function setSaturday08(?bool $saturday08): self
    {
        $this->saturday08 = $saturday08;

        return $this;
    }

    public function isSaturday09(): ?bool
    {
        return $this->saturday09;
    }

    public function setSaturday09(?bool $saturday09): self
    {
        $this->saturday09 = $saturday09;

        return $this;
    }

    public function isSaturday10(): ?bool
    {
        return $this->saturday10;
    }

    public function setSaturday10(?bool $saturday10): self
    {
        $this->saturday10 = $saturday10;

        return $this;
    }

    public function isSaturday11(): ?bool
    {
        return $this->saturday11;
    }

    public function setSaturday11(?bool $saturday11): self
    {
        $this->saturday11 = $saturday11;

        return $this;
    }

    public function isSaturday12(): ?bool
    {
        return $this->saturday12;
    }

    public function setSaturday12(?bool $saturday12): self
    {
        $this->saturday12 = $saturday12;

        return $this;
    }

    public function isSaturday13(): ?bool
    {
        return $this->saturday13;
    }

    public function setSaturday13(?bool $saturday13): self
    {
        $this->saturday13 = $saturday13;

        return $this;
    }

    public function isSaturday14(): ?bool
    {
        return $this->saturday14;
    }

    public function setSaturday14(?bool $saturday14): self
    {
        $this->saturday14 = $saturday14;

        return $this;
    }

    public function isSaturday15(): ?bool
    {
        return $this->saturday15;
    }

    public function setSaturday15(?bool $saturday15): self
    {
        $this->saturday15 = $saturday15;

        return $this;
    }

    public function isSaturday16(): ?bool
    {
        return $this->saturday16;
    }

    public function setSaturday16(?bool $saturday16): self
    {
        $this->saturday16 = $saturday16;

        return $this;
    }

    public function isSaturday17(): ?bool
    {
        return $this->saturday17;
    }

    public function setSaturday17(?bool $saturday17): self
    {
        $this->saturday17 = $saturday17;

        return $this;
    }

    public function isSaturday18(): ?bool
    {
        return $this->saturday18;
    }

    public function setSaturday18(?bool $saturday18): self
    {
        $this->saturday18 = $saturday18;

        return $this;
    }

    public function isSaturday19(): ?bool
    {
        return $this->saturday19;
    }

    public function setSaturday19(?bool $saturday19): self
    {
        $this->saturday19 = $saturday19;

        return $this;
    }

    public function isSaturday20(): ?bool
    {
        return $this->saturday20;
    }

    public function setSaturday20(?bool $saturday20): self
    {
        $this->saturday20 = $saturday20;

        return $this;
    }

    public function isSaturday21(): ?bool
    {
        return $this->saturday21;
    }

    public function setSaturday21(?bool $saturday21): self
    {
        $this->saturday21 = $saturday21;

        return $this;
    }

    public function isSaturday22(): ?bool
    {
        return $this->saturday22;
    }

    public function setSaturday22(?bool $saturday22): self
    {
        $this->saturday22 = $saturday22;

        return $this;
    }

    public function isSaturday23(): ?bool
    {
        return $this->saturday23;
    }

    public function setSaturday23(?bool $saturday23): self
    {
        $this->saturday23 = $saturday23;

        return $this;
    }

    public function isSunday00(): ?bool
    {
        return $this->sunday00;
    }

    public function setSunday00(?bool $sunday00): self
    {
        $this->sunday00 = $sunday00;

        return $this;
    }

    public function isSunday01(): ?bool
    {
        return $this->sunday01;
    }

    public function setSunday01(?bool $sunday01): self
    {
        $this->sunday01 = $sunday01;

        return $this;
    }

    public function isSunday02(): ?bool
    {
        return $this->sunday02;
    }

    public function setSunday02(?bool $sunday02): self
    {
        $this->sunday02 = $sunday02;

        return $this;
    }

    public function isSunday03(): ?bool
    {
        return $this->sunday03;
    }

    public function setSunday03(?bool $sunday03): self
    {
        $this->sunday03 = $sunday03;

        return $this;
    }

    public function isSunday04(): ?bool
    {
        return $this->sunday04;
    }

    public function setSunday04(?bool $sunday04): self
    {
        $this->sunday04 = $sunday04;

        return $this;
    }

    public function isSunday05(): ?bool
    {
        return $this->sunday05;
    }

    public function setSunday05(?bool $sunday05): self
    {
        $this->sunday05 = $sunday05;

        return $this;
    }

    public function isSunday06(): ?bool
    {
        return $this->sunday06;
    }

    public function setSunday06(?bool $sunday06): self
    {
        $this->sunday06 = $sunday06;

        return $this;
    }

    public function isSunday07(): ?bool
    {
        return $this->sunday07;
    }

    public function setSunday07(?bool $sunday07): self
    {
        $this->sunday07 = $sunday07;

        return $this;
    }

    public function isSunday08(): ?bool
    {
        return $this->sunday08;
    }

    public function setSunday08(?bool $sunday08): self
    {
        $this->sunday08 = $sunday08;

        return $this;
    }

    public function isSunday09(): ?bool
    {
        return $this->sunday09;
    }

    public function setSunday09(?bool $sunday09): self
    {
        $this->sunday09 = $sunday09;

        return $this;
    }

    public function isSunday10(): ?bool
    {
        return $this->sunday10;
    }

    public function setSunday10(?bool $sunday10): self
    {
        $this->sunday10 = $sunday10;

        return $this;
    }

    public function isSunday11(): ?bool
    {
        return $this->sunday11;
    }

    public function setSunday11(?bool $sunday11): self
    {
        $this->sunday11 = $sunday11;

        return $this;
    }

    public function isSunday12(): ?bool
    {
        return $this->sunday12;
    }

    public function setSunday12(?bool $sunday12): self
    {
        $this->sunday12 = $sunday12;

        return $this;
    }

    public function isSunday13(): ?bool
    {
        return $this->sunday13;
    }

    public function setSunday13(?bool $sunday13): self
    {
        $this->sunday13 = $sunday13;

        return $this;
    }

    public function isSunday14(): ?bool
    {
        return $this->sunday14;
    }

    public function setSunday14(?bool $sunday14): self
    {
        $this->sunday14 = $sunday14;

        return $this;
    }

    public function isSunday15(): ?bool
    {
        return $this->sunday15;
    }

    public function setSunday15(?bool $sunday15): self
    {
        $this->sunday15 = $sunday15;

        return $this;
    }

    public function isSunday16(): ?bool
    {
        return $this->sunday16;
    }

    public function setSunday16(?bool $sunday16): self
    {
        $this->sunday16 = $sunday16;

        return $this;
    }

    public function isSunday17(): ?bool
    {
        return $this->sunday17;
    }

    public function setSunday17(?bool $sunday17): self
    {
        $this->sunday17 = $sunday17;

        return $this;
    }

    public function isSunday18(): ?bool
    {
        return $this->sunday18;
    }

    public function setSunday18(?bool $sunday18): self
    {
        $this->sunday18 = $sunday18;

        return $this;
    }

    public function isSunday19(): ?bool
    {
        return $this->sunday19;
    }

    public function setSunday19(?bool $sunday19): self
    {
        $this->sunday19 = $sunday19;

        return $this;
    }

    public function isSunday20(): ?bool
    {
        return $this->sunday20;
    }

    public function setSunday20(?bool $sunday20): self
    {
        $this->sunday20 = $sunday20;

        return $this;
    }

    public function isSunday21(): ?bool
    {
        return $this->sunday21;
    }

    public function setSunday21(?bool $sunday21): self
    {
        $this->sunday21 = $sunday21;

        return $this;
    }

    public function isSunday22(): ?bool
    {
        return $this->sunday22;
    }

    public function setSunday22(?bool $sunday22): self
    {
        $this->sunday22 = $sunday22;

        return $this;
    }

    public function isSunday23(): ?bool
    {
        return $this->sunday23;
    }

    public function setSunday23(?bool $sunday23): self
    {
        $this->sunday23 = $sunday23;

        return $this;
    }


}
