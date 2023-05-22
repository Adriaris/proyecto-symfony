<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="FRIENDS")
 */
class Friend
{
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DENIED = 'denied';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="id_user_1")
     */
    private $userId1;

    /**
     * @ORM\Column(type="integer", name="id_user_2")
     */
    private $userId2;

    /**
     * @ORM\Column(type="string", length=40, name="friendship_status")
     */
    private $friendshipStatus;

    /**
     * @ORM\Column(type="boolean", name="user_1_locked")
     */
    private $user1Locked;

    /**
     * @ORM\Column(type="boolean", name="user_2_locked")
     */
    private $user2Locked;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId1(): ?int
    {
        return $this->userId1;
    }

    public function setUserId1(int $userId1): self
    {
        $this->userId1 = $userId1;

        return $this;
    }

    public function getUserId2(): ?int
    {
        return $this->userId2;
    }

    public function setUserId2(int $userId2): self
    {
        $this->userId2 = $userId2;

        return $this;
    }

    public function getFriendshipStatus(): ?string
    {
        return $this->friendshipStatus;
    }

    public function setFriendshipStatus(string $friendshipStatus): self
    {
        $this->friendshipStatus = $friendshipStatus;

        return $this;
    }

    public function isUser1Locked(): ?bool
    {
        return $this->user1Locked;
    }

    public function setUser1Locked(bool $user1Locked): self
    {
        $this->user1Locked = $user1Locked;

        return $this;
    }

    public function isUser2Locked(): ?bool
    {
        return $this->user2Locked;
    }

    public function setUser2Locked(bool $user2Locked): self
    {
        $this->user2Locked = $user2Locked;

        return $this;
    }
}
