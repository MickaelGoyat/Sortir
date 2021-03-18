<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscriptions
 *
 * @ORM\Table(name="inscriptions", indexes={@ORM\Index(name="inscriptions_participants_fk", columns={"participants_no_participant"})})
 * @ORM\Entity
 */
class Inscriptions
{
    /**
     * @var int
     *
     * @ORM\Column(name="sorties_no_sortie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $sortiesNoSortie;

    /**
     * @var int
     *
     * @ORM\Column(name="participants_no_participant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $participantsNoParticipant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="date", nullable=false)
     */
    private $dateInscription;

    /**
     * Inscriptions constructor.
     * @param int $sortiesNoSortie
     * @param int $participantsNoParticipant
     * @param \DateTime $dateInscription
     */
    public function __construct(int $sortiesNoSortie, int $participantsNoParticipant, \DateTime $dateInscription)
    {
        $this->sortiesNoSortie = $sortiesNoSortie;
        $this->participantsNoParticipant = $participantsNoParticipant;
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return int
     */
    public function getSortiesNoSortie(): int
    {
        return $this->sortiesNoSortie;
    }

    /**
     * @param int $sortiesNoSortie
     */
    public function setSortiesNoSortie(int $sortiesNoSortie): void
    {
        $this->sortiesNoSortie = $sortiesNoSortie;
    }

    public function getParticipantsNoParticipant(): ?int
    {
        return $this->participantsNoParticipant;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }


}
