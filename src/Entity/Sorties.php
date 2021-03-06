<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SortiesRepository;

/**
 * Sorties
 *
 * @ORM\Table(name="sorties", indexes={@ORM\Index(name="sorties_lieux_fk", columns={"lieux_no_lieu"}), @ORM\Index(name="sorties_participants_fk", columns={"organisateur"})})
 * @ORM\Entity(repositoryClass=SortiesRepository::class)
 */
class Sorties
{
    /**
     * @var int
     *
     * @ORM\Column(name="no_sortie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noSortie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="datedebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecloture", type="date", nullable=false)
     */
    private $datecloture;

    /**
     * @var int
     *
     * @ORM\Column(name="nbinscriptionsmax", type="integer", nullable=false)
     */
    private $nbinscriptionsmax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descriptioninfos", type="string", length=500, nullable=true)
     */
    private $descriptioninfos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etats", inversedBy="sorties")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="no_etat")
     */
    private $etatsortie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="urlPhoto", type="string", length=250, nullable=true)
     */
    private $urlphoto;

    /**
     * @var int
     *
     * @ORM\Column(name="organisateur", type="integer", nullable=false)
     */
    private $organisateur;

    /**
     * @var int
     *
     * @ORM\Column(name="lieux_no_lieu", type="integer", nullable=false)
     */
    private $lieuxNoLieu;


    /**
     * @return int
     */
    public function getNoSortie(): int
    {
        return $this->noSortie;
    }

    /**
     * @param int $noSortie
     */
    public function setNoSortie(int $noSortie): void
    {
        $this->noSortie = $noSortie;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut(): \DateTime
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut(\DateTime $datedebut): void
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return int|null
     */
    public function getDuree(): ?int
    {
        return $this->duree;
    }

    /**
     * @param int|null $duree
     */
    public function setDuree(?int $duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return \DateTime
     */
    public function getDatecloture(): \DateTime
    {
        return $this->datecloture;
    }

    /**
     * @param \DateTime $datecloture
     */
    public function setDatecloture(\DateTime $datecloture): void
    {
        $this->datecloture = $datecloture;
    }

    /**
     * @return int
     */
    public function getNbinscriptionsmax(): int
    {
        return $this->nbinscriptionsmax;
    }

    /**
     * @param int $nbinscriptionsmax
     */
    public function setNbinscriptionsmax(int $nbinscriptionsmax): void
    {
        $this->nbinscriptionsmax = $nbinscriptionsmax;
    }

    /**
     * @return string|null
     */
    public function getDescriptioninfos(): ?string
    {
        return $this->descriptioninfos;
    }

    /**
     * @param string|null $descriptioninfos
     */
    public function setDescriptioninfos(?string $descriptioninfos): void
    {
        $this->descriptioninfos = $descriptioninfos;
    }

    /**
     * @return Etats|null
     */

    public function getEtatsortie(): ?Etats
    {
        return $this->etatsortie;
    }

    /**
     * @return Etats
     */
    public function setEtatsortie(Etats $etatsortie): Etats
    {
        return $this->etatsortie = $etatsortie;
    }

    /**
     * @return string|null
     */
    public function getUrlphoto(): ?string
    {
        return $this->urlphoto;
    }

    /**
     * @param string|null $urlphoto
     */
    public function setUrlphoto(?string $urlphoto): void
    {
        $this->urlphoto = $urlphoto;
    }

    /**
     * @return int
     */
    public function getOrganisateur(): int
    {
        return $this->organisateur;
    }

    /**
     * @param int $organisateur
     */
    public function setOrganisateur(int $organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return int
     */
    public function getLieuxNoLieu(): int
    {
        return $this->lieuxNoLieu;
    }

    /**
     * @param int $lieuxNoLieu
     */
    public function setLieuxNoLieu(int $lieuxNoLieu): void
    {
        $this->lieuxNoLieu = $lieuxNoLieu;
    }


}
