<?php
// src/Entity/Ticket.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tickets")
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $reporter_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $reported_id;

    /**
     * @ORM\Column(type="text")
     */
    private $ticket_description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ticketStatus = 'pending'; // Valor por defecto


    public function getTicketStatus(): ?string
    {
        return $this->ticketStatus;
    }

    public function setTicketStatus(string $ticketStatus): self
    {
        $this->ticketStatus = $ticketStatus;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReporterId(): ?int
    {
        return $this->reporter_id;
    }

    public function setReporterId(int $reporter_id): self
    {
        $this->reporter_id = $reporter_id;

        return $this;
    }

    public function getReportedId(): ?int
    {
        return $this->reported_id;
    }

    public function setReportedId(int $reported_id): self
    {
        $this->reported_id = $reported_id;

        return $this;
    }

    public function getTicketDescription(): ?string
    {
        return $this->ticket_description;
    }

    public function setTicketDescription(string $ticket_description): self
    {
        $this->ticket_description = $ticket_description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
