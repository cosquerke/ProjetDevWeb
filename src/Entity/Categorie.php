<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=9999999999999999)
     * @ORM\JoinColumn(nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=CryptoMonnaie::class, inversedBy="categorie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cryptomonnaie;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCryptomonnaie(): ?CryptoMonnaie
    {
        return $this->cryptomonnaie;
    }

    public function setCryptomonnaie(?CryptoMonnaie $cryptomonnaie): self
    {
        $this->cryptomonnaie = $cryptomonnaie;

        return $this;
    }
}
