<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $titre;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $isbn;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateEdition;

    public function __construct(array $init = [])
    {
        $this->hydrate($init);
        $this->exemplaires = new ArrayCollection();    
    }

    public function hydrate (array $vals){
        foreach ($vals as $key=> $val){
            $method = "set" . ucfirst($key);
            if (method_exists($this,$method)){
                $this->$method ($val);
            }
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

}
