<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Participants
 *
 * @ORM\Table(name="participants", uniqueConstraints={@ORM\UniqueConstraint(name="participants_pseudo_uk", columns={"pseudo"})})
 * @ORM\Entity
 */
class Participants implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="no_participant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noParticipant;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=30, nullable=false, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=true)
     */
    private $prenom;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=10, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string",length=100, nullable=false)
     */
    private $mail;

    /**
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private string $password;


    /**
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sites", inversedBy="participants")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="no_site")
     */
    private $sitesNoSite;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $reset_token;

    /**
     * @return int
     */
    public function getNoParticipant(): int
    {
        return $this->noParticipant;
    }

    /**
     * @param int $noParticipant
     */
    public function setNoParticipant(int $noParticipant): void
    {
        $this->noParticipant = $noParticipant;
    }

    public function getUsername(): ?string
    {
        return $this->pseudo;
    }

    public function setUsername(string $username): self
    {
        $this->pseudo = $username;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $email): self
    {
        $this->mail = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): iterable
    {
        return $this->roles;
    }

    /**
     * @param array|iterable $roles
     */
    public function setRoles(iterable $roles): void
    {
        $this->roles = $roles;
    }


    /**
     * @return bool
     */
    public function isActif(): bool
    {
        return $this->actif;
    }

    /**
     * @param bool $actif
     */
    public function setActif(bool $actif): void
    {
        $this->actif = $actif;
    }

    /**
     * @return int
     */
    /**
     */
    public function getSitesNoSite()
    {
        return $this->sitesNoSite;
    }

    /**
     */
    public function setSitesNoSite($sitesNoSite): void
    {
        $this->sitesNoSite = $sitesNoSite;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // $this->password = '';
        return null;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
    }

}
