<?php

namespace App\Entity;

use App\Repository\CryptoMonnaieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;
use config\configVar;


/**
 * @ORM\Entity(repositoryClass=CryptoMonnaieRepository::class)
 */
class CryptoMonnaie
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
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="cryptoFav")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="cryptomonnaie")
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $symbole;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCryptoFav($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCryptoFav() === $this) {
                $user->setCryptoFav(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setCryptomonnaie($this);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getCryptomonnaie() === $this) {
                $categorie->setCryptomonnaie(null);
            }
        }

        return $this;
    }

    public function getSymbole(): ?string
    {
        return $this->symbole;
    }

    public function setSymbole(string $symbole): self
    {
        $this->symbole = $symbole;

        return $this;
    }

    public function getTabCrypto(){
        $sql = "SELECT * FROM crypto_monnaie";
        $madb = \config\configVar::cxBdd();
        $res = $madb -> query($sql);
        if($res) {
            $tab = $res -> fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            $tab = "err";
        }
        $tabRes = array();
        foreach ($tab as $key => $object){
            $crypto = new CryptoMonnaie();
            $crypto->setNom($object["nom"]);
            $crypto->setPrix($object["prix"]);
            $crypto->setSymbole($object["symbole"]);
            $crypto->setLogo($object["logo"]);
            array_push($tabRes,$crypto);
        }
        return $tabRes;
    }
}
