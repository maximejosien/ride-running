<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={"groups"={"ride-read"}},
 *          "denormalization_context"={"groups"={"write"}}
 *      },
 *      itemOperations={"get"},
 *      collectionOperations={"get"}
 * )
 */
class Ride
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups("ride-read")
     */
    private $id;

    /**
     * @var float|null
     *
     * @ORM\Column(type="float")
     *
     * @Groups("ride-read")
     */
    private $duration;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     *
     * @Groups("ride-read")
     */
    private $distance;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text")
     *
     * @Groups("ride-read")
     */
    private $description;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime")
     *
     * @Groups("ride-read")
     */
    private $startAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="rides")
     *
     * @Groups("ride-read")
     */
    private $author;

    /**
     * @var RideType|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RideType")
     *
     * @Groups("ride-read")
     */
    private $rideType;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @param float|null $duration
     *
     * @return $this
     */
    public function setDuration(?float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     *
     * @return $this
     */
    public function setDistance(?int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartAt(): ?\DateTime
    {
        return $this->startAt;
    }

    /**
     * @param \DateTime|null $startAt
     *
     * @return $this
     */
    public function setStartAt(?\DateTime $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     *
     * @return $this
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return RideType|null
     */
    public function getRideType(): ?RideType
    {
        return $this->rideType;
    }

    /**
     * @param RideType|null $rideType
     *
     * @return $this
     */
    public function setRideType(?RideType $rideType): self
    {
        $this->rideType = $rideType;

        return $this;
    }
}
