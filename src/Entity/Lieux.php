<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LieuxRepository;

/**
 * Lieux
 *
 * @ORM\Table(name="lieux", indexes={@ORM\Index(name="lieux_villes_fk", columns={"villes_no_ville"})})
 * @ORM\Entity(repositoryClass=LieuxRepository::class)
 */
class Lieux
{

    public function  __constuct()
    {


    }
    /**
     * @return int
     */
    public function getNoLieu(): int
    {
        return $this->noLieu;
    }

    /**
     * @param int $noLieu
     */
    public function setNoLieu(int $noLieu): void
    {
        $this->noLieu = $noLieu;
    }

    /**
     * @return string
     */
    public function getNomLieu(): string
    {
        return $this->nomLieu;
    }

    /**
     * @param string $nomLieu
     */
    public function setNomLieu(string $nomLieu): void
    {
        $this->nomLieu = $nomLieu;
    }

    /**
     * @return string|null
     */
    public function getRue(): ?string
    {
        return $this->rue;
    }

    /**
     * @param string|null $rue
     */
    public function setRue(?string $rue): void
    {
        $this->rue = $rue;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     */
    public function setLatitude(?float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     */
    public function setLongitude(?float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getVillesNoVille(): int
    {
        return $this->villesNoVille;
    }

    /**
     * @param int $villesNoVille
     */
    public function setVillesNoVille(int $villesNoVille): void
    {
        $this->villesNoVille = $villesNoVille;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="no_lieu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $noLieu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_lieu", type="string", length=30, nullable=false)
     */
    private string $nomLieu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rue", type="string", length=30, nullable=true)
     */
    private ?string $rue;

    /**
     * @var float|null
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=true)
     */
    private ?float $latitude;

    /**
     * @var float|null
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=true)
     */
    private ?float $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="villes_no_ville", type="integer", nullable=false)
     */
    private int $villesNoVille;

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->nomLieu;
    }


}
