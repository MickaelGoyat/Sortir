<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Villes
 *
 * @ORM\Table(name="villes")
 * @ORM\Entity
 */
class Villes
{
    /**
     * @var int
     *
     * @ORM\Column(name="no_ville", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noVille;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_ville", type="string", length=30, nullable=false)
     */
    private $nomVille;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=10, nullable=false)
     */
    private $codePostal;

    /**
     * Villes constructor.
     * @param int $noVille
     * @param string $nomVille
     * @param string $codePostal
     */
    public function __construct(int $noVille, string $nomVille, string $codePostal)
    {
        $this->noVille = $noVille;
        $this->nomVille = $nomVille;
        $this->codePostal = $codePostal;
    }

    /**
     * @return int
     */
    public function getNoVille(): int
    {
        return $this->noVille;
    }

    /**
     * @param int $noVille
     */
    public function setNoVille(int $noVille): void
    {
        $this->noVille = $noVille;
    }

    /**
     * @return string
     */
    public function getNomVille(): string
    {
        return $this->nomVille;
    }

    /**
     * @param string $nomVille
     */
    public function setNomVille(string $nomVille): void
    {
        $this->nomVille = $nomVille;
    }

    /**
     * @return string
     */
    public function getCodePostal(): string
    {
        return $this->codePostal;
    }

    /**
     * @param string $codePostal
     */
    public function setCodePostal(string $codePostal): void
    {
        $this->codePostal = $codePostal;
    }


}
