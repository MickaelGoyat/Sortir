<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etats
 *
 * @ORM\Table(name="etats")
 * @ORM\Entity
 */
class Etats
{
    /**
     * @var int
     *
     * @ORM\Column(name="no_etat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=30, nullable=false)
     */
    private $libelle;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sorties", mappedBy="etatsorties")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="no_sorties")
     */
    private $sorties;

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function __toString(): string
    {
        return $this->libelle;

    }


}
