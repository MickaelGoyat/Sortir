<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SitesRepository;

/**
 * Sites
 *
 * @ORM\Table(name="sites")
 * @ORM\Entity(repositoryClass=SitesRepository::class)
 */
class Sites
{
    /**
     * Sites constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getNoSite(): int
    {
        return $this->noSite;
    }

    /**
     * @param int $noSite
     */
    public function setNoSite(int $noSite): void
    {
        $this->noSite = $noSite;
    }

    /**
     * @return string
     */
    public function getNomSite(): string
    {
        return $this->nomSite;
    }

    /**
     * @param string $nomSite
     */
    public function setNomSite(string $nomSite): void
    {
        $this->nomSite = $nomSite;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="no_site", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noSite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_site", type="string", length=30, nullable=false)
     */
    private $nomSite;

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->nomSite;
    }

}
